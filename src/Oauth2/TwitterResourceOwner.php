<?php

namespace Procorbin\BirdElephant\Oauth2;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class TwitterResourceOwner implements ResourceOwnerInterface {

    /**
     * @var array
     */
    protected $response;

    /**
     * @param array $response
     */
    public function __construct(array $response) {
        $this->response = $response['data'] ?? [];
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->response['id'];
    }

    /**
     * @return array
     */
    public function toArray(): array {
        return $this->response;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->response['name'];
    }

    /**
     * @return mixed
     */
    public function getUsername() {
        return $this->response['username'];
    }

    /**
     * @return mixed
     */
    public function getProfileImageUrl() {
        return $this->response['profile_image_url'];
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function getResponseValue($key) {
        return $this->response[$key] ?? null;
    }
}
