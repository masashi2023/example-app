<?php

namespace Tests\Unit\Service;

use App\Services\TweetService;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase; 
use Illuminate\Foundation\Testing\RefreshDatabase;

class TweetServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    use RefreshDatabase;

    public function test_check_own_tweet(): void
    {
        // TweetServiceのインスタンスを生成
        $tweetService = new TweetService();

        $result = $tweetService->checkOwnTweet(1, 1);

        // assertTrueは（）の中がtrueになるか
        $this->assertTrue($result);

        $result = $tweetService->checkOwnTweet(2, 1);

        // assertTrueは（）の中がtrueになるか
        $this->assertFalse($result);
    }
}
