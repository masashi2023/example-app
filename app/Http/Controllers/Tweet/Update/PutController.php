<?php

namespace App\Http\Controllers\Tweet\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tweet\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Services\TweetService;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class PutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request,TweetService $tweetService)
    {
        //
        // $tweetId = (int)$request->route('tweetId');
        // ログインしたユーザと変更するつぶやきのIDが一致するかチェックする
        if(!$tweetService->checkOwnTweet($request->id(),$request->user()->id)){
            throw new AccessDeniedHttpException();
        }
        $tweet = Tweet::where('id',$request->id())->firstOrFail();
        $tweet->content = $request->tweet();
        $tweet->save();

        return redirect()->route('tweet.update.index',['tweetId'=>$request->id()])->with('feedback.success','つぶやきを編集しました');
    }
}
