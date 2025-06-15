<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\HasilTryout;
use App\Models\JawabanUser;
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
        $waktuHabis = $request->input('waktu_habis', 0);
        $paket = Paket::with('soals')->findOrFail($id);
        $totalQuestions = count($paket->soals);
        $correctAnswers = 0;
        $wrongAnswers = 0;
        $userId = Auth::id();

        foreach ($paket->soals as $soal) {
            $inputName = 'jawaban-' . $soal->id;
            $userAnswer = $request->input($inputName);

            if ($userAnswer) {
                // Save individual answer to jawaban_users table
                JawabanUser::create([
                    'user_id' => $userId,
                    'paket_id' => $paket->id,
                    'soal_id' => $soal->id,
                    'jawaban_user' => $userAnswer
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
            'waktu_selesai' => now()
        ]);

        // Redirect to detailed results page
        return redirect()->route('tryout.hasil', ['id' => $hasil->id]);
    }

    public function hasil($hasil_id)
    {
        // Find the HasilTryout record
        $hasil = HasilTryout::with(['paket'])->findOrFail($hasil_id);

        // Check if the result belongs to the authenticated user
        if ($hasil->user_id != Auth::id()) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke hasil tryout ini.');
        }

        return redirect()->route('dashboard.hasil', ['hasil_id' => $hasil_id]);
    }
    /**
     * Process the tryout submission and show results
     *
     * @param Request $request
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
}
