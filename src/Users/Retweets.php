<?php

namespace Procorbin\BirdElephant\Users;

use Procorbin\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

class Retweets extends ApiBase {

    /**
     * Auth credentials
     *
     * @var array
     */
    protected $credentials;

    /**
     * A Twitter username
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
     * @param string $target_tweet_id
     * @return object
     * @throws GuzzleException
     */
    public function retweet(string $target_tweet_id): object {
        $id = $this->getUserId($this->username, $this->credentials);

        if ($id == null) {
            return $id;
        }

        $path = 'users/'.$id.'/retweets';
        $data = [
            'tweet_id' => $target_tweet_id
        ];
        return $this->post($this->credentials, $path, null, $data, false, true);
    }


    /**
     * @param string $target_tweet_id
     * @return object
     * @throws GuzzleException
     */
    public function unretweet(string $target_tweet_id): object {
        $id = $this->getUserId($this->username, $this->credentials);

        if ($id == null) {
            return $id;
        }

        $path = 'users/'.$id.'/retweets/'.$target_tweet_id;

        return $this->delete($this->credentials, $path, null, null, false, true);
    }
}
