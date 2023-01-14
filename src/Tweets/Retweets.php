<?php

namespace Procorbin\BirdElephant\Tweets;

use GuzzleHttp\Exception\GuzzleException;
use Procorbin\BirdElephant\ApiBase;

/**
 * Lookup and manage retweets
 */
class Retweets extends ApiBase {

    protected $credentials;

    /**
     * @param $credentials
     */
    public function __construct($credentials) {
        $this->credentials = $credentials;
    }

    /**
     * Allows you to get information about a Tweet’s retweeters.
     * You will receive the most recent 100 users who retweeted the specified Tweet.
     *
     * @param string $tweet_id - the tweet id
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function retweetedBy(string $tweet_id, array $params): object {
        $path = 'tweets/'.$tweet_id.'/retweeted_by';
        return $this->get($this->credentials, $path, $params, null, false, false);
    }
}
