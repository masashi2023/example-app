<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Services\TweetService;
use Illuminate\Http\Request;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,TweetService $tweetService)
    {
        //送られてきたつぶやきのID
        $tweetId = (int)$request->route('tweetId');

        // ログインしたユーザと変更するつぶやきのIDが一致するかチェックする
        if(!$tweetService->checkOwnTweet($tweetId,$request->user()->id)){
            throw new AccessDeniedHttpException();
        }

        $tweet = Tweet::where('id',$tweetId)->firstOrFail();

        // dd($tweet);
        // if(is_null($tweet)){
        //     throw new NotFoundHttpException('存在しないつぶやきです。');
        // }

        return view('tweet.update')->with('tweet',$tweet);
    }
}
