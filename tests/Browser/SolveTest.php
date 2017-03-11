<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Trio;

class SolveTest extends DuskTestCase
{

    public function testCanSolveTrio()
    {
        $this->browse(function ($browser) {
            //Go to solve screen
            $browser->visit('/solve');
            $browser->pause(500);
            //Get current trio answer so we can answer correctly
            $trioId = $browser->text('#trio-id');
            sleep(1);
            $trio = Trio::findOrFail($trioId);
            $answer = $trio->answer;

            //Save first sentence so we can see if it changes later
            $sentence = $browser->value('#sentence1');
            //Input answer
            $browser->type('#answer', $answer);
            //Click check
            $browser->click('#check-button');
            sleep(1);
            //See if button changed
            $browser->assertSeeIn('#check-button', 'Correct, next trio');
            //Click again
            $browser->click('#check-button');
            //See if new trio is loaded
            $browser->assertDontSeeIn('#sentence1', $sentence);
            //See if buttons are reset
            //TODO
        });
    }
}
