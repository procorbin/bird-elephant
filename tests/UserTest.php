<?php

namespace Procorbin\Tests;

use Procorbin\BirdElephant\User;
use Procorbin\BirdElephant\Users\Lists;
use GuzzleHttp\Exception\GuzzleException;

class UserTest extends BaseTest
{
    protected $credentials;
    protected $username;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->credentials = $this->setUpCredentials();
        $this->username = 'procorbin';
        $this->user = new User($this->credentials, $this->username);
    }


    /**
     * @throws GuzzleException
     */
    public function testFollowing() {
        $case = $this->user->following();
        $this->assertIsArray($case->data);
    }


    /**
     * @throws GuzzleException
     */
    public function testTweets() {
        $case = $this->user->tweets();
        $this->assertIsArray($case->data);
    }

    /**
     * @throws GuzzleException
     */
    public function testGet()
    {
        $case = $this->user->get();
        $this->assertIsObject($case->data);
    }

    /**
     * @throws GuzzleException
     */
    public function testLikes()
    {
        $case = $this->user->likes();
        $this->assertIsArray($case->data);
    }

    public function testLists()
    {
        $lists = $this->user->lists();
        $this->assertInstanceOf(Lists::class, $lists);
    }

    /**
     * @throws GuzzleException
     */
    public function testBlocks()
    {
        $case = $this->user->blocks();
        $this->assertIsArray($case->data);
    }

    /**
     * @throws GuzzleException
     */
    public function testMentions()
    {
        $case = $this->user->mentions();
        $this->assertIsArray($case->data);
    }

    /**
     * @throws GuzzleException
     */
    public function testFollow()
    {
        $user = 'dril';
        $case = $this->user->follow($user);
        $this->assertIsObject($case->data);
    }

    /**
     * @throws GuzzleException
     */
    public function testMutes()
    {
        $case = $this->user->mutes();
        $this->assertIsArray($case->data);
    }

    /**
     * @throws GuzzleException
     */
    public function testFollowers() {
        $case = $this->user->followers();
        $this->assertIsArray($case->data);
    }
}
