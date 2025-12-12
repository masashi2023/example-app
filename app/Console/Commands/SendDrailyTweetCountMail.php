<?php

namespace App\Console\Commands;

use App\Services\TweetService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Mail\Mailer;
use App\Models\User;
use App\Mail\DailyTweetCount;

class SendDrailyTweetCountMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send-draily-tweet-count-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '前日のつぶやき数を集計してつぶやきを促すメールを送ります。';

    private TweetService $tweetService;
    private Mailer $mailer;

    public function __construct(TweetService $tweetService,Mailer $mailer)
    {
        parent::__construct();
        $this->tweetService = $tweetService;
        $this->mailer =  $mailer;
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //昨日のつぶやきの件数
        $tweetCount = $this->tweetService->countYesterdayTweets();

        // 全ユーザーにメール送信
        $users = User::get();

        foreach($users as $user){
            $this->mailer->to($user->email)->send(new DailyTweetCount($user,$tweetCount));
        }

        return 0;
    }
}
