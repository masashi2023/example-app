<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Services\TweetService;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,TweetService $tweetService)
    {
        //
        // return view('tweet.index',['name'=>'laravel']);

        // $tweets = Tweet::all();
        // 依存性あり
        // $tweetService = new TweetService();

        $tweets = $tweetService->getTweets();
        return view('tweet.index')->with('tweets',$tweets);
    }
}
