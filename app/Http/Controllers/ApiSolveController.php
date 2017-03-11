<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trio;
use App\WrongAnswer;
use App\UserTrioAttempt;

class ApiSolveController extends Controller
{
    function getTrio(Trio $trio) {
        return $trio->toJson();
    }

    function getTrioAnswer(Trio $trio) {
        $return = [
            "id" => $trio->id,
            "correctAnswer" => $trio->answer
        ];

        return json_encode($return);
    }

    function getRandomTrio() {
        $trio = Trio::inRandomOrder()->first();

        return $trio->toJson();
    }

    function postCheck(Request $request, Trio $trio) {
        //JSON response
        $response = [
            'answer' =>[
                'id' => $trio->id,
                'attemptedAnswer' => '',
                'isCorrect' => false
            ]
        ];

        $answer = $request->input('answer');

        // Czyścimy input
        // Usuwamy spacje i tabulatory z początku i końca
        $answer = trim($answer);
        // Zamieniamy na małe litery
        $answer = mb_strtolower($answer);

        //Zwracamy obrobioną odpowiedź od użytkownika
        $response['answer']['attemptedAnswer'] = $answer;
        $this->updateStats($request->user() ? $request->user()->id : 0, $trio->id, $answer == $trio->answer);

        // Sprawdzamy odpowiedź
        if($answer == $trio->answer) {
            // Poprawna
            $response['answer']['isCorrect'] = true;

        } else {
            // Błędna
            // Zapisujemy błędną odpowiedź
            $this->saveWrongAnswer($trio->id, $answer);
        }

        //Zwracamy JSON

        return json_encode($response);

    }

    private function updateStats($user_id, $trio_id, $correct) {

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

    private function saveWrongAnswer($trio_id, $answer) {
        $wrongAnswer = new WrongAnswer;
        $wrongAnswer->trio_id = $trio_id;
        $wrongAnswer->answer = $answer;
        $wrongAnswer->save();
    }
}
