<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SubscribeToThreadsTest extends TestCase
{
    use DatabaseMigrations;


    /** @test */
    public function a_user_can_subscribe_to_threads(){
        $this->signIn();

        // wenn wir ein Thread haben
        $thread = create('App\Thread');
        //un wir haben ein user, der diesen thread abonniert hat
        $this->post($thread->path() . '/subscriptions');

        $this->assertCount(1, $thread->fresh()->subscriptions);


    }

    /** @test */
    public function a_user_can_unsubscribe_from_a_thread(){
        $this->signIn();

        $thread = create('App\Thread');

        $thread->subscribe();

        $this->delete($thread->path() . '/subscriptions');

        $this->assertCount(0,$thread->subscriptions);
    }

}