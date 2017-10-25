<?php

namespace Tests\Feature;

use Illuminate\Notifications\DatabaseNotification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NotificationsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    function a_notification_is_prepared_when_a_subscribed_thread_receives_a_reply_that_is_not_by_the_current_user()
    {
        $thread = create('App\Thread')->subscribe();

        $this->assertCount(0, auth()->user()->notifications);

        //wenn wir selber ein Reply verfassen
        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'Some reply here'
        ]);

        //dann soll uns keine notification gegeben werden
        $this->assertCount(0, auth()->user()->fresh()->notifications);

        //wenn jemand anderes eine reply schreibt
        $thread->addReply([
            'user_id' => create('App\User')->id,
            'body' => 'Some reply here'
        ]);
        $this->assertCount(1, auth()->user()->fresh()->notifications);

    }

    /** @test */
    function a_user_can_fetch_their_unread_notifications()
    {
        create(DatabaseNotification::class);

        $this->assertCount(
            1,
            $this->getJson("/profiles/". auth()->user()->name . "/notifications")->json()
        );


        /* Das oben ist das gleiche, wie wir unten auskommentiert haben.
           Dazu haben wir uns einen Faker in der ModelFactory.php geschrieben.
           Weil wir hier drei mal das selbe machen, kann man das auch so machen*/

        ##################################################################################

        /*$thread = create('App\Thread')->subscribe();

        $thread->addReply([
            'user_id' => create('App\User')->id,
            'body' => 'Some reply here'
        ]);
        */



    }

    /** @test */
    function a_user_can_mark_a_notification_as_read()
    {
        create(DatabaseNotification::class);


        $user = auth()->user();

        $this->assertCount(1, $user->unreadNotifications);

        $notificationId = $user->unreadNotifications->first()->id;

        $this->delete("/profiles/{$user->name}/notifications/{$notificationId}");

        $this->assertCount(0, $user->fresh()->unreadNotifications);


    }



}
