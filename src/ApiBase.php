<?php

namespace Procorbin\BirdElephant;

use Procorbin\BirdElephant\Users\UserLookup;
use GuzzleHttp\Exception\GuzzleException;

class ApiBase {

    /**
     * @param array $credentials
     * @param string $http_method
     * @param mixed $options
     * @return object
     * @throws GuzzleException
     */
    private function go(array $credentials, string $http_method, $options): object {
        $request = new Request($credentials);
        return $request->authorisedRequest($http_method, ...$options);
    }

    /**
     * @param array $credentials
     * @param  ...$options
     * @return object
     * @throws GuzzleException
     */
    protected function get(array $credentials, ...$options): object {
        return $this->go($credentials, 'GET', $options);
    }

    /**
     * @param array $credentials
     * @param ...$options
     * @return object
     * @throws GuzzleException
     */
    protected function post(array $credentials, ...$options): object {
        return $this->go($credentials, 'POST', $options);
    }

    /**
     * @param array $credentials
     * @param ...$options
     * @return object
     * @throws GuzzleException
     */
    protected function put(array $credentials, ...$options): object {
        return $this->go($credentials, 'PUT', $options);
    }

    /**
     * @param array $credentials
     * @param ...$options
     * @return object
     * @throws GuzzleException
     */
    protected function delete(array $credentials, ...$options): object {
        return $this->go($credentials, 'DELETE', $options);
    }

    /**
     * @param $username
     * @param $credentials
     * @return string|null
     * @throws GuzzleException
     */
    protected function getUserId($username, $credentials): ?string {
        $user = new UserLookup($credentials);
        return $user->getUserIdFromUsername($username);
    }
}
