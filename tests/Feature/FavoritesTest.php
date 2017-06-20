<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_can_not_favorite_anything()
    {
        $this->withExceptionHandling()
            ->post('replies/1/favorites')
            ->assertRedirect('/login');

    }

    /** @test */
    public function an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();

        $reply = create('App\Reply');

        $this->post('replies/' . $reply->id . '/favorites');

        //dd(\App\Favorite::all());
        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function an_authenticated_user_may_favorite_a_reply_once()
    {
        $this->signIn();

        $reply = create('App\Reply');
        try {
            $this->post('replies/' . $reply->id . '/favorites');
            $this->post('replies/' . $reply->id . '/favorites');
        }catch (\Exception $e){
            $this->fail('Did not to expect to insert the same record set twice.');
        }

        //dd(\App\Favorite::all())->toArray();
        $this->assertCount(1, $reply->favorites);
    }


}
