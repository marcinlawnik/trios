<?php

namespace App\Http\Controllers;

use App\Trio;
use App\UserTrioAttempt;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index() {
        $stats = [
            'triosCount' => Trio::all()->count(),
            'totalAttempts' => UserTrioAttempt::totalAttempts(),
            'correctAnswers' => UserTrioAttempt::totalSolved(),
            'triosSolved' => UserTrioAttempt::triosSolved(),
            'mostSolved' => UserTrioAttempt::mostSolvedTrios(),
            'hardest' => UserTrioAttempt::hardestTrios()
        ];

        return view('pages.admin.stats.index')->with('stats', $stats);
    }
}
