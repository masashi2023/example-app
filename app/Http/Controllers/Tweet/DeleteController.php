<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Services\TweetService;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,TweetService $tweetService)
    {
        //tweetIdの取得
        $tweetId = (int) $request->route('tweetId');
        // ログインしたユーザと変更するつぶやきのIDが一致するかチェックする
        if(!$tweetService->checkOwnTweet($tweetId,$request->user()->id)){
            throw new AccessDeniedHttpException();
        }

        $tweetService->deleteTweet($tweetId);

        return redirect()->route('tweet.index')->with('feedback.success','つぶやきを削除しました。');
    }
}
