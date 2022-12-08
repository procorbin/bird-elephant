<?php

namespace  Procorbin\Tests;

use Procorbin\BirdElephant\BirdElephant;
use Procorbin\BirdElephant\Tweets;
use Procorbin\BirdElephant\Tweets\TweetCounts;
use PHPUnit\Framework\TestCase;

class TweetsTest extends BaseTest
{
    protected $credentials;
    protected $tweets;

    protected function setUp(): void
    {
        parent::setUp();

        $this->credentials = $this->setUpCredentials();
        $this->tweets = new Tweets($this->credentials);
    }

    public function testReply()
    {
        $case = $this->tweets->reply();
        self::assertInstanceOf(Tweets\Reply::class, $case);
    }

    public function testSearch()
    {
        $case = $this->tweets->search();
        self::assertInstanceOf(Tweets\Search::class, $case);
    }

    public function testCount()
    {
        $case = $this->tweets->count();
        self::assertInstanceOf(Tweets\TweetCounts::class, $case);
    }
}
