<?php

namespace App\Http\Controllers;

use App\Models\HasilTryout;
use App\Models\JawabanUser;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TryoutController extends Controller
{
    public function index()
    {
        $pakets = Paket::all();

        return view('tryout.index', compact('pakets'));
    }

    public function mulai($id)
    {
        $paket = Paket::with(['soals' => function ($query) {
            $query->orderBy('id', 'asc');
        }])->findOrFail($id);

        return view('tryout.mulai', compact('paket'));
    }

    public function submit(Request $request, $id)
    {
        $paket = Paket::with('soals')->findOrFail($id);
        $totalQuestions = count($paket->soals);
        $correctAnswers = 0;
        $wrongAnswers = 0;
        $userId = Auth::id();

        foreach ($paket->soals as $soal) {
            $inputName = 'jawaban-'.$soal->id;
            $userAnswer = $request->input($inputName);

            if ($userAnswer) {
                // Save individual answer to jawaban_users table
                JawabanUser::create([
                    'user_id' => $userId,
                    'paket_id' => $paket->id,
                    'soal_id' => $soal->id,
                    'jawaban_user' => $userAnswer,
                ]);

                // Check if answer is correct
                if ($userAnswer === $soal->jawaban_benar) {
                    $correctAnswers++;
                } else {
                    $wrongAnswers++;
                }
            } else {
                $wrongAnswers++; // Count unanswered as wrong
            }
        }

        // Calculate percentage score
        $percentageScore = ($totalQuestions > 0) ? (($correctAnswers / $totalQuestions) * 100) : 0;
        $percentageScore = round($percentageScore, 2);

        // Save overall result to hasil_tryouts table
        $hasil = HasilTryout::create([
            'user_id' => $userId,
            'paket_id' => $paket->id,
            'jumlah_benar' => $correctAnswers,
            'jumlah_salah' => $wrongAnswers,
            'skor' => $percentageScore,
            'waktu_mulai' => now()->subMinutes($request->input('duration', 0)),
            'waktu_selesai' => now(),
        ]);

        // Redirect to detailed results page
        return redirect()->route('tryout.hasil', ['id' => $hasil->id]);
    }

    public function hasil($id)
    {
        // Find the HasilTryout record
        $hasil = HasilTryout::with(['paket'])->findOrFail($id);

        // Check if the result belongs to the authenticated user
        if ($hasil->user_id != Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke hasil tryout ini.');
        }

        // Find previous attempts to determine the start time for this attempt
        $previousAttempt = HasilTryout::where('user_id', Auth::id())
            ->where('paket_id', $hasil->paket_id)
            ->where('created_at', '<', $hasil->created_at)
            ->orderByDesc('created_at')
            ->first();

        // If there was a previous attempt, get answers after it was completed
        // If this was the first attempt, get all answers from the beginning
        $startTime = $previousAttempt ? $previousAttempt->waktu_selesai : null;

        // Get only this attempt's answers
        $jawaban = \App\Models\JawabanUser::where('user_id', Auth::id())
            ->where('paket_id', $hasil->paket_id)
            ->when($startTime, function ($query) use ($startTime) {
                return $query->where('created_at', '>', $startTime);
            })
            ->where('created_at', '<=', $hasil->waktu_selesai)
            ->with('soal')
            ->get()
            ->map(function ($item) {
                $item->is_correct = $item->jawaban_user === $item->soal->jawaban_benar;

                return $item;
            });

        // Count correct and incorrect answers
        $jawabanBenar = $jawaban->filter(function ($item) {
            return $item->is_correct;
        });

        $jawabanSalah = $jawaban->filter(function ($item) {
            return ! $item->is_correct;
        });

        return view('tryout.hasil', compact('hasil', 'jawaban', 'jawabanBenar', 'jawabanSalah'));
    }

    /**
     * Process the tryout submission and show results
     *
     * @return \Illuminate\Http\Response
     */
    public function selesai(Request $request)
    {
        // Assuming validation and input processing is done above

        // Calculate score and save the result
        $totalSoal = count($request->jawaban);
        $jawabanBenar = 0;

        // Logic to calculate correct answers and save them to the database
        // ...

        // Create the HasilTryout record
        $hasil = HasilTryout::create([
            'user_id' => Auth::id(),
            'paket_id' => $request->paket_id,
            'skor' => ($jawabanBenar / $totalSoal) * 100,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => now(),
        ]);

        // Redirect to the hasil page with explanations
        return redirect()->route('tryout.hasil', ['hasil_id' => $hasil->id]);
    }

    /**
     * Export tryout results to PDF
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function exportPdf($id)
    {
        $hasil = HasilTryout::with(['paket', 'user'])->findOrFail($id);

        // Check if the result belongs to the authenticated user
        if ($hasil->user_id != Auth::id() && Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke hasil tryout ini.');
        }

        // Find previous attempts to determine the start time for this attempt
        $previousAttempt = HasilTryout::where('user_id', $hasil->user_id)
            ->where('paket_id', $hasil->paket_id)
            ->where('created_at', '<', $hasil->created_at)
            ->orderByDesc('created_at')
            ->first();

        // If there was a previous attempt, get answers after it was completed
        // If this was the first attempt, get all answers from the beginning
        $startTime = $previousAttempt ? $previousAttempt->waktu_selesai : null;

        // Get only this attempt's answers
        $jawaban = \App\Models\JawabanUser::where('user_id', $hasil->user_id)
            ->where('paket_id', $hasil->paket_id)
            ->when($startTime, function ($query) use ($startTime) {
                return $query->where('created_at', '>', $startTime);
            })
            ->where('created_at', '<=', $hasil->waktu_selesai)
            ->with('soal')
            ->get()
            ->map(function ($item) {
                $item->is_correct = $item->jawaban_user === $item->soal->jawaban_benar;

                return $item;
            });

        // Count correct and incorrect answers
        $jawabanBenar = $jawaban->filter(function ($item) {
            return $item->is_correct;
        });

        $jawabanSalah = $jawaban->filter(function ($item) {
            return ! $item->is_correct;
        });

        // Generate PDF
        $pdf = \PDF::loadView('pdf.hasil-tryout', [
            'hasil' => $hasil,
            'jawaban' => $jawaban,
            'jawabanBenar' => $jawabanBenar,
            'jawabanSalah' => $jawabanSalah,
        ]);

        // Set filename
        $filename = 'hasil-tryout-'.$hasil->paket->judul.'-'.now()->format('Ymd').'.pdf';

        // Download the PDF
        return $pdf->download($filename);
    }
}
