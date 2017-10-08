<?php

namespace Tests\Unit;

use App\Notifications\ThreadWasUpdated;
use App\Spam;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SpamTest extends TestCase
{


    /** @test */
    function it_validates_spam()
    {
       $spam = new Spam();

       $this->assertFalse($spam->detect('Innocent reply here'));

    }


}
