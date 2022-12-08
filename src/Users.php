<?php

namespace Procorbin\BirdElephant;

use Procorbin\BirdElephant\Users\UserLookup;
use GuzzleHttp\Exception\GuzzleException;

class Users {

    protected $credentials;
    private $userLookup;

    /**
     * @param $credentials
     */
    public function __construct($credentials) {
        $this->credentials = $credentials;
        $this->userLookup = new UserLookup($this->credentials);
    }

    /**
     * @param array $usernames
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function lookup(array $usernames, array $params = []): object {
        return $this->userLookup->getMultipleUsersByUsername($usernames, $params);
    }
}
