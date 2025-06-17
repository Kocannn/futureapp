<?php

namespace App\Http\Controllers;

use App\Models\HasilTryout;
use App\Models\Paket;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    public function index()
    {
        // Fetch all available packages
        $pakets = Paket::orderBy('created_at', 'desc')->get();

        // Get attempt counts for current user
        $userId = Auth::id();
        $attemptCounts = HasilTryout::where('user_id', $userId)
            ->selectRaw('paket_id, COUNT(*) as count')
            ->groupBy('paket_id')
            ->pluck('count', 'paket_id')
            ->toArray();

        // Pass the packages and attempt counts to the dashboard view
        return view('dashboard', compact('pakets', 'attemptCounts'));
    }

    /**
     * Display the results of a completed tryout with explanations
     *
     * @param  int  $hasil_id
     * @return \Illuminate\Http\Response
     */
    public function showHasil($hasil_id)
    {
        $hasil = HasilTryout::with(['paket'])->findOrFail($hasil_id);

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
            ->with(['soal' => function ($query) {
                $query->select('id', 'pertanyaan', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e', 'jawaban_benar', 'pembahasan');
            }])
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
     * Display all tryout results for the current user
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $userId = Auth::id();

        // Get all results grouped by paket
        $results = HasilTryout::where('user_id', $userId)
            ->with('paket')
            ->orderByDesc('created_at')
            ->get()
            ->groupBy('paket_id');

        // Get attempt counts for each paket
        $attemptCounts = HasilTryout::where('user_id', $userId)
            ->selectRaw('paket_id, COUNT(*) as count')
            ->groupBy('paket_id')
            ->pluck('count', 'paket_id')
            ->toArray();

        return view('tryout.history', compact('results', 'attemptCounts'));
    }

    /**
     * Export user's tryout history to PDF
     *
     * @return \Illuminate\Http\Response
     */
    public function exportHistoryPdf()
    {
        $userId = Auth::id();
        $user = Auth::user();

        // Get all results grouped by paket
        $results = HasilTryout::where('user_id', $userId)
            ->with('paket')
            ->orderByDesc('created_at')
            ->get()
            ->groupBy('paket_id');

        // Get attempt counts for each paket
        $attemptCounts = HasilTryout::where('user_id', $userId)
            ->selectRaw('paket_id, COUNT(*) as count')
            ->groupBy('paket_id')
            ->pluck('count', 'paket_id')
            ->toArray();

        // Generate PDF
        $pdf = \PDF::loadView('pdf.history-tryout', [
            'user' => $user,
            'results' => $results,
            'attemptCounts' => $attemptCounts,
            'date' => now()->format('d F Y'),
        ]);

        // Set filename
        $filename = 'riwayat-tryout-'.$user->name.'-'.now()->format('Ymd').'.pdf';

        // Download the PDF
        return $pdf->download($filename);
    }
}
