<?php

namespace Procorbin\BirdElephant\Users;

use Procorbin\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

class Mutes extends ApiBase {

    /**
     * Auth credentials
     *
     * @var array
     */
    protected $credentials;

    /**
     * A Twitter handle
     *
     * @var string
     */
    protected $username;

    /**
     * @param $credentials
     * @param $username
     */
    public function __construct($credentials, $username) {
        $this->credentials = $credentials;
        $this->username = $username;
    }

    /**
     * Lookup muted users for an
     * authenticated user account.
     *
     * @param array $params
     * @return object|null
     * @throws GuzzleException
     */
    public function lookup(array $params): object {
        $id = $this->getUserId($this->username, $this->credentials);

        if ($id == null) {
            return $id;
        }

        $path = 'users/'.$id.'/muting';

        return $this->get($this->credentials, $path, $params, null, false, true);
    }

    /**
     * mutes a named user
     *
     * @param string $target_username
     * @return object|null
     * @throws GuzzleException
     */
    public function mute(string $target_username): object {
        $id = $this->getUserId($this->username, $this->credentials);

        if ($id == null) {
            return $id;
        }

        $path = 'users/'.$id.'/muting';
        $target_user_id = $this->getUserId($target_username, $this->credentials);

        if ($target_user_id == null) {
            return $target_user_id;
        }

        $data = [
            'target_user_id' => $target_user_id
        ];
        return $this->post($this->credentials, $path, null, $data, false, true);
    }

    /**
     * Unmutes a named user
     *
     * @param string $target_username
     * @return object|null
     * @throws GuzzleException
     */
    public function unmute(string $target_username): object {
        $id = $this->getUserId($this->username, $this->credentials);

        if ($id == null) {
            return $id;
        }

        $target_user_id = $this->getUserId($target_username, $this->credentials);

        if ($target_user_id == null) {
            return $target_user_id;
        }

        $path = 'users/'.$id.'/muting/'.$target_user_id;

        return $this->delete($this->credentials, $path, null, null, false, true);
    }
}
