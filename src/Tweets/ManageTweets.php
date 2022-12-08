<?php

namespace Procorbin\BirdElephant\Tweets;

use Procorbin\BirdElephant\ApiBase;
use Procorbin\BirdElephant\Request;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Posting and deleting tweets
 */
class ManageTweets extends ApiBase {

    /**
     * Twitter Credentials
     *
     * @var array
     */
    protected $credentials;

    /**
     * Base endpoint
     *
     * @var string
     */
    protected $endpoint = 'tweets';

    /**
     * @param $credentials
     */
    public function __construct($credentials) {
        $this->credentials = $credentials;
    }

    /**
     * Send a tweet
     *
     * @param object $tweet
     * @return object
     * @throws GuzzleException
     */
    public function send(object $tweet): object {
        $tweet = $tweet->build();
        return $this->post($this->credentials, $this->endpoint, null, $tweet, false, true);
    }

    /**
     * Delete tweet
     *
     * @param string $tweet_id
     * @return object
     * @throws GuzzleException
     */
    public function unsend(string $tweet_id): object {
        $path = $this->endpoint . '/' . $tweet_id;
        return $this->delete($this->credentials, $path, null, null, false, true);
    }

    /**
     * Basic media upload via the API v1.1 because
     * media upload not yet available on v2
     *
     * @param string $file
     * @return object
     * @throws GuzzleException
     */
    public function mediaUpload(string $file): object {
        $request = new Request($this->credentials);
        return $request->uploadMedia($file);
    }
}
