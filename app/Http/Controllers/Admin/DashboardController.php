<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\HasilTryout;
use App\Models\Paket;
use App\Models\JawabanUser;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get counts for dashboard stats
        $users_count = User::where('role', 'user')->count();
        $pakets_count = Paket::count();
        $soals_count = Soal::count();
        $results_count = HasilTryout::count();

        // Get top performers (limit to 5)
        $top_performers = HasilTryout::with(['user', 'paket'])
            ->select('user_id', DB::raw('MAX(skor) as highest_score'), DB::raw('MIN(waktu_selesai) as best_time'))
            ->groupBy('user_id')
            ->orderByDesc('highest_score')
            ->orderBy('best_time')
            ->limit(5)
            ->get()
            ->map(function ($result) {
                return [
                    'user' => $result->user,
                    'score' => $result->highest_score,
                    'time' => $result->best_time
                ];
            });


        return view('admin.dashboard', compact(
            'users_count',
            'pakets_count',
            'soals_count',
            'results_count',
            'top_performers'
        ));
    }

    // ✅ Daftar Semua User
    public function users()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.user.index', compact('users'));
    }

    // ✅ Daftar Semua Hasil Tryout
    public function hasilTryout()
    {
        // Get all results with their relationships
        $hasilAll = HasilTryout::with(['user', 'paket'])->orderByDesc('created_at')->get();

        // Group results by paket first
        $hasilByPaket = $hasilAll->groupBy('paket_id');

        // For each paket, group by user and calculate attempt numbers
        $groupedHasil = collect();
        foreach ($hasilByPaket as $paketId => $paketResults) {
            $paket = $paketResults->first()->paket;

            // Group by user to calculate attempts
            $userAttempts = [];
            foreach ($paketResults->groupBy('user_id') as $userId => $userResults) {
                // Sort by creation date to determine attempt number
                $sortedResults = $userResults->sortBy('created_at');
                $attemptNumber = 1;

                foreach ($sortedResults as $result) {
                    $result->attempt_number = $attemptNumber++;
                    $userAttempts[] = $result;
                }
            }

            // Sort all attempts for this paket by date (newest first)
            $sortedAttempts = collect($userAttempts)->sortByDesc('created_at');

            $groupedHasil->put($paketId, [
                'paket' => $paket,
                'attempts' => $sortedAttempts
            ]);
        }

        return view('admin.hasil.index', compact('hasilAll', 'groupedHasil'));
    }

    // ✅ Daftar Peringkat Berdasarkan Paket
    public function peringkat($paket_id)
    {
        $paket = Paket::findOrFail($paket_id);
        $peringkat = HasilTryout::with('user')
            ->where('paket_id', $paket_id)
            ->orderByDesc('skor')
            ->orderBy('waktu_selesai')
            ->get();

        return view('admin.peringkat.show', compact('paket', 'peringkat'));
    }

    // ✅ Daftar Paket untuk Memilih Peringkat
    public function listPaketPeringkat()
    {
        $pakets = Paket::all();
        return view('admin.peringkat.index', compact('pakets'));
    }
    /**
     * Show the detailed result of a specific tryout attempt
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function hasilShow($id)
    {
        // Find the HasilTryout record
        $hasil = HasilTryout::with(['user', 'paket'])->findOrFail($id);

        // Calculate attempt number
        $attemptNumber = HasilTryout::where('user_id', $hasil->user_id)
            ->where('paket_id', $hasil->paket_id)
            ->where('created_at', '<=', $hasil->created_at)
            ->orderBy('created_at')
            ->count();

        $hasil->attempt_number = $attemptNumber;

        // Get only this attempt's answers
        // Find previous attempts to determine the start time for this attempt
        $previousAttempt = HasilTryout::where('user_id', $hasil->user_id)
            ->where('paket_id', $hasil->paket_id)
            ->where('created_at', '<', $hasil->created_at)
            ->orderByDesc('created_at')
            ->first();

        // If there was a previous attempt, get answers after it was completed
        // If this was the first attempt, get all answers from the beginning
        $startTime = $previousAttempt ? $previousAttempt->waktu_selesai : null;

        $jawaban = JawabanUser::where('user_id', $hasil->user_id)
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

        $jawaban_detail = $jawaban;

        // Group the soals by their correctness
        $jawabanBenar = $jawaban->filter(function ($item) {
            return $item->jawaban_user === $item->soal->jawaban_benar;
        });

        $jawabanSalah = $jawaban->filter(function ($item) {
            return $item->jawaban_user !== $item->soal->jawaban_benar;
        });

        return view('admin.hasil.show', compact('hasil', 'jawaban', 'jawabanBenar', 'jawabanSalah', 'jawaban_detail'));
    }
    /**
     * Display the top overall rankings across all packages
     *
     * @return \Illuminate\Http\Response
     */
    public function topRankings()
    {
        // Get the highest score per user across all packages
        $topScores = HasilTryout::select('user_id', DB::raw('MAX(skor) as highest_score'))
            ->groupBy('user_id')
            ->orderByDesc('highest_score')
            ->limit(100)
            ->get();

        // Fetch the complete results for each top score
        $rankings = collect();
        foreach ($topScores as $score) {
            $result = HasilTryout::with(['user', 'paket'])
                ->where('user_id', $score->user_id)
                ->where('skor', $score->highest_score)
                ->orderBy('waktu_selesai')
                ->first();

            if ($result) {
                $rankings->push($result);
            }
        }

        return view('admin.peringkat.top', compact('rankings'));
    }
    /**
     * Display results grouped by package
     *
     * @return \Illuminate\Http\Response
     */
    public function hasilPaket()
    {
        // Get all packages that have results
        $pakets = Paket::whereHas('hasilTryouts')->get();

        return view('admin.hasil.paket', compact('pakets'));
    }

    public function show($id)
    {
        // This is a generic show method being added to prevent the error
        // Redirect to the specific hasilShow method which is already implemented
        return $this->hasilShow($id);
    }
}
