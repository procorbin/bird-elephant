<?php

namespace Procorbin\Tests;

use Procorbin\BirdElephant\BirdElephant;
use Procorbin\BirdElephant\Compliance;
use Procorbin\BirdElephant\Lists;
use Procorbin\BirdElephant\Spaces;
use Procorbin\BirdElephant\Tweets;
use Procorbin\BirdElephant\User;
use Procorbin\BirdElephant\Users;

class BirdElephantTest extends BaseTest
{
    protected array $credentials;

    protected function setUp(): void
    {
        parent::setUp();

        $this->credentials = $this->setUpCredentials();
        $this->app = new BirdElephant($this->credentials);
    }

    public function testUser()
    {
        $case = $this->app->user('coderjerk');
        self::assertInstanceOf(User::class, $case);
    }

    public function testTweets()
    {
        $case = $this->app->tweets();
        self::assertInstanceOf(Tweets::class, $case);
    }

    public function testCompliance()
    {
        $case = $this->app->compliance();
        self::assertInstanceOf(Compliance::class, $case);
    }

    public function testLists()
    {
        $case = $this->app->lists();
        self::assertInstanceOf(Lists::class, $case);
    }

    public function testSpaces()
    {
        $case = $this->app->spaces();
        self::assertInstanceOf(Spaces::class, $case);
    }

    public function testUsers()
    {
        $case = $this->app->users();
        self::assertInstanceOf(Users::class, $case);
    }
}
