<?php

namespace Tests\Unit;

use App\Notifications\ThreadWasUpdated;
use App\Inspections\Spam;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SpamTest extends TestCase
{


    /** @test */
    function it_checks_for_invalid_keywords()
    {
        //invalid keywords

       $spam = new Spam();

       $this->assertFalse($spam->detect('Innocent reply here'));

       $this->expectException('Exception');


       $spam->detect('yahoo customer support');

    }

    /** @test */
    function it_checks_for_any_key_being_held_down()
    {
        //invalid keywords

        $spam = new Spam();


        $this->expectException('Exception');

        $spam->detect('Hello world aaaaa');


    }


}
