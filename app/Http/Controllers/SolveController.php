<?php

namespace App\Http\Controllers;

use App\Trio;
use App\WrongAnswer;
use App\UserTrioAttempt;
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

        $this->updateStats($request->user() ? $request->user()->id : 0, $trio->id, $answer == $trio->answer);

        // Sprawdzamy odpowiedź
        if($answer == $trio->answer) {
            // Poprawna
            $request->session()->flash('message', 'Good answer!');
            return redirect()->action('SolveController@show', Trio::inRandomOrder()->first()->id);
        } else {
            // Błędna

            // Zapisujemy błędną odpowiedź
            $this->saveWrongAnswer($trio->id, $answer);

            $request->session()->flash('error', 'Wrong answer!');
            return redirect()->action('SolveController@show', $trio->id);
        }
    }

    private function updateStats($user_id, $trio_id, $correct) {
        // Śledzimy tylko użytkowników
        if($user_id !== 0)
        {
            $trioAttempts = UserTrioAttempt::where('trio_id', $trio_id)
                ->where('user_id', $user_id)->first();

            // Sprawdzamy czy użytk. próbował rozwiącać to trio
            if($trioAttempts === null) {
                // Jeśli nie to tworzymy statystykę dla trio
                $trioAttempts = new UserTrioAttempt;
                $trioAttempts->trio_id = $trio_id;
                $trioAttempts->user_id = $user_id;
                $trioAttempts->attempts = 1;
                $trioAttempts->solved = false;
            } else {
                $trioAttempts->attempts++;
            }

            if($correct) {
                $trioAttempts->solved = true;
            }

            $trioAttempts->save();
        }
    }

    private function saveWrongAnswer($trio_id, $answer) {
        $wrongAnswer = new WrongAnswer;
        $wrongAnswer->trio_id = $trio_id;
        $wrongAnswer->answer = $answer;
        $wrongAnswer->save();
    }
}
