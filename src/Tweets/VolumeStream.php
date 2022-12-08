<?php

namespace Procorbin\BirdElephant\Tweets;

use Procorbin\BirdElephant\Request;
use GuzzleHttp\Exception\GuzzleException;

class VolumeStream {

    /**
     * endpoint
     *
     * @var string
     */
    public $uri = 'tweets/sample/stream';

    private $credentials;

    /**
     * @param $credentials
     */
    public function __construct($credentials) {
        $this->credentials = $credentials;
    }

    /**
     * Connects to filtered stream
     *
     * @param array|null $params
     * @return object
     * @throws GuzzleException
     */
    public function connectToStream(array $params = null): object {
        $request = new Request($this->credentials);
        return $request->authorisedRequest('GET', $this->uri, $params, null, true);
    }
}
