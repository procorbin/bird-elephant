<?php

namespace Procorbin\BirdElephant\Tweets;

use Procorbin\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Returns information about a Tweet or group
 * of Tweets, specified by a Tweet ID.
 */
class TweetLookup extends ApiBase {

    /**
     * The endpoint base
     *
     * @var string
     */
    public $endpoint_base = 'tweets';

    /**
     * Tokens and secrets
     *
     * @var array
     */
    protected $credentials;

    /**
     * @param array $credentials
     */
    public function __construct(array $credentials) {
        $this->credentials = $credentials;
    }

    /**
     * Get a single tweet
     *
     * @param string $id
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function getTweet(string $id, array $params): object {
        $path = $this->endpoint_base . '/' . $id;

        return $this->get($this->credentials, $path, $params);
    }

    /**
     * Get multiple tweets
     *
     * @param array $ids
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function getTweets(array $ids, array $params): object {
        if (count($ids) === 1) {
            $this->getTweet($ids[0], $params);
        }

        $path = $this->endpoint_base;
        $params['ids'] = join(',', $ids);

        return $this->get($this->credentials, $path, $params);
    }
}
