<?php

namespace Procorbin\BirdElephant;

use Procorbin\BirdElephant\Users\UserLookup;
use GuzzleHttp\Exception\GuzzleException;

class Me {

    /**
     * Tokens and secrets
     *
     * @var array
     */
    protected $credentials;

    /**
     * @var UserLookup
     */
    protected $userLookup;

    public function __construct($credentials) {
        $this->credentials = $credentials;
        $this->userLookup = new UserLookup($credentials);
    }

    /**
     * Gets information about the authorised user.
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function myself(array $params = []): object {
        return $this->userLookup->getMe($params);
    }
}
