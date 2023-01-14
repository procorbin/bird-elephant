<?php

namespace Procorbin\BirdElephant\Users;

use Exception;
use Procorbin\BirdElephant\ApiBase;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Save Tweets and easily access them later.
 *
 * @author Corbin Cyrille <procorbin@wanadoo.fr>
 * @since 0.4.8
 */
class Bookmarks extends ApiBase {

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
     * The endpoint uri
     *
     * @var string
     */
    protected $uri;

    /**
     * @param $credentials
     * @param $username
     * @throws GuzzleException
     * @throws Exception
     */
    public function __construct($credentials, $username) {
        $this->credentials = $credentials;
        $user_id = $this->getUserId($username, $credentials);

        if ($user_id === null) {
            throw new Exception('The username of this account is unknown to Twitter');
        }

        $this->uri = 'users/'.$user_id.'/bookmarks';
    }

    /**
     * Lookup bookmarks for the authenticated user
     *
     * @param array $params
     * @return object
     * @throws GuzzleException
     */
    public function lookup(array $params): object {
        return $this->get($this->credentials, $this->uri, $params, null, false, true);
    }

    /**
     * @param string $target_tweet_id
     * @return object
     * @throws GuzzleException
     */
    public function bookmark(string $target_tweet_id): object {
        $data = [
            'tweet_id' => $target_tweet_id
        ];

        return $this->post($this->credentials, $this->uri, null, $data, false, true);
    }

    /**
     * @param string $target_tweet_id
     * @return object
     * @throws GuzzleException
     */
    public function unbookmark(string $target_tweet_id): object {
        $path = $this->uri.'/'.$target_tweet_id;

        return $this->delete($this->credentials, $path, null, null, false, true);
    }
}
