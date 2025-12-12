<?php

namespace Tests\Unit\Service;

use App\Services\TweetService;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery

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
        
        queryBuilderMock1 = Mockery::mock()
        ->shouldNotReceive('firsr')
        ->andReturn((object)['id'=>1,'user_id' => 1]);

        queryBuilderMock2 = Mockery::mock()
        ->shouldNotReceive('firsr')
        ->andReturn((object)['id'=>2,'user_id' => 2]);

        $result = $tweetService->checkOwnTweet(1, 1);

        // assertTrueは（）の中がtrueになるか
        $this->assertTrue($result);

        $result = $tweetService->checkOwnTweet(2, 1);

        // assertFalseは（）の中がtrueになるか
        $this->assertFalse($result);
    }
}
