<?php
namespace Procorbin\Tests;

use Procorbin\BirdElephant\Users;
use GuzzleHttp\Exception\GuzzleException;

class UsersTest extends BaseTest
{
    protected array $credentials;
    protected string $username;
    protected Users $users;

    protected function setUp(): void
    {
        parent::setUp();

        $this->credentials = $this->setUpCredentials();
        $this->username = 'shibablastar';
        $this->users = new Users($this->credentials, $this->username);
    }

    /**
     * @throws GuzzleException
     */
    public function testLookup()
    {
        $users = $this->users->lookup(['shibablastar', 'dril', 'spanish__eddie']);
        self::assertIsArray($users->data);
    }
}
