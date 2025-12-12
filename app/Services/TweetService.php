<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Tweet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TweetService
{
    public function getTweets()
    {
        return $tweets = Tweet::with('images')->orderBy('created_at', 'DESC')->get();
    }

    // ログインした本人か確認する
    public function checkOwnTweet(int $tweetId, int $userId): bool
    {

        $tweet = Tweet::where('id', $tweetId)->first();
        // つぶやきがあるかどうか
        if (!$tweet) {
            return false;
        }

        // ログインしているIDと一致しているか
        return $tweet->user_id === $userId;
    }

    //昨日のつぶやきの件数をカウント
    public function countYesterdayTweets(): int
    {
        return Tweet::whereDate('created_at', '>=', Carbon::yesterday()->toDateTimeString())
            ->whereDate('created_at', '<', Carbon::today()->toDateTimeString())->count();
    }

    // つぶやき作成（ファイル処理を追加）
    public function saveTweet(int $userId, string $content, array $images)
    {
        DB::transaction(function () use ($userId, $content, $images) {

            // tweetsテーブルの操作
            $tweet = new Tweet();

            // contentカラムに挿入する（つぶやきの内容）
            $tweet->content = $content;

            // user_idカラムに挿入する（ログインユーザーのID）
            $tweet->user_id = $userId;

            // 保存
            $tweet->save();

            // 画像の処理

            foreach ($images as $image) {
                // ファイルのアップロード
                Storage::putFile('images', $image);

                // imagesテーブルにデータ挿入
                $imageModel = new Image();
                $imageModel->name = $image->hashName();
                $imageModel->save();

                // imagesテーブルとtweetsテーブルの中間テーブルtweet_imagesテーブルに画像データ追加
                $tweet->images()->attach($imageModel->id);
            }
        });
    }

    // つぶやき削除
    public function deleteTweet(int $tweetId)
    {
        DB::transaction(function () use ($tweetId) {
            // tweetIdからレコードを抽出
            $tweet = Tweet::where('id', $tweetId)->firstOrFail();

            // 画像の削除
            $tweet->images()->each(function($image){

                // ファイルパス
                $filePath ='images/'.$image->name;

                if(Storage::exists($filePath)){
                    Storage::delete($filePath);
                }
                $image->delete();
            });

            // レコードの削除
            $tweet->delete();
        });
    }
}
