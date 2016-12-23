<?php

namespace App\Http\Controllers;

use App\Trio;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index() {

        $stats = [
            'triosCount' => Trio::all()->count()
        ];

        return view('pages.admin.stats.index')->with('stats', $stats);
    }
}
