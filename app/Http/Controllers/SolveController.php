<?php

namespace App\Http\Controllers;

use App\Trio;
use Illuminate\Http\Request;

class SolveController extends Controller
{
    public function getRandom() {
        $trio = Trio::inRandomOrder()->first();
        return view('pages.solve')->with('trio', $trio);
    }

    public function show(Trio $trio) {
        return view('pages.solve')->with('trio', $trio);
    }

    public function check(Request $request, Trio $trio) {
        $answer = $request->input('answer');

        // Czyścimy input
        // Usuwamy spacje i tabulatory z początku i końca
        $answer = trim($answer);
        // Zamieniamy na małe litery
        $answer = mb_strtolower($answer);

        // Sprawdzamy odpowiedź
        if($answer == $trio->answer) {
            // Poprawna
            $request->session()->flash('message', 'Good answer!');
            return redirect()->action('SolveController@show', Trio::inRandomOrder()->first()->id);
        } else {
            // Błędna
            $request->session()->flash('error', 'Wrong answer!');
            return redirect()->action('SolveController@show', $trio->id);
        }
    }

}
