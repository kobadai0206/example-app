<?php

namespace Tests\Unit\Service;

use App\Modules\ImageUpload\ImageManagerInterface;
use PHPUnit\Framework\TestCase;
use App\Services\TweetService;
use Mockery;


class TweetServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     * 
     * @runInSeparateProcess
     * @return void
     */
    public function test_check_own_tweet()
    {
        

        $mock = Mockery::mock('alias:App\models\Tweet');
        $mock->shouldReceive('where->first')->andReturn((object)[
            'id' => 1,
            'user_id' => 1
        ]);
        $imageManager = Mockery::mock(ImageManagerInterface::class);
        $tweetService = new TweetService($imageManager); // TweetServiceのインスタンスを作成

        $result = $tweetService->checkOwnTweet(1, 1);
        $this->assertTrue($result);

        $result = $tweetService->checkOwnTweet(2, 1);
        $this->assertFalse($result);
    }
}
