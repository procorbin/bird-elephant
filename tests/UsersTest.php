<?php
namespace Procorbin\Tests;

use Procorbin\BirdElephant\Users;
use GuzzleHttp\Exception\GuzzleException;

class UsersTest extends BaseTest
{
    protected $credentials;
    protected $username;
    protected $users;

    /**
     * @return void
     */
    protected function setUp(): void {
        parent::setUp();

        $this->credentials = $this->setUpCredentials();
        $this->username = 'procorbin';
        $this->users = new Users($this->credentials);
    }

    /**
     * @throws GuzzleException
     */
    public function testLookup() {
        $users = $this->users->lookup([$this->username, 'dril', 'spanish__eddie']);
        self::assertIsArray($users->data);
    }
}
