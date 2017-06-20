<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Reply;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply)
    {
         $reply->favorite();
        //$reply->favorites()->create(['user_id' => auth()->id()]);
        return back();
    }

}