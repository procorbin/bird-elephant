<?php

namespace Procorbin\BirdElephant;

use Procorbin\BirdElephant\Spaces\SpacesLookup;

/**
 * "Spaces is a new way to have live audio conversations on Twitter."
 *
 * https://help.twitter.com/en/using-twitter/spaces
 */
class Spaces {

    /**
     * Tokens and secrets
     *
     * @var array
     */
    protected array $credentials;

    /**
     * @param $credentials
     */
    public function __construct($credentials) {
        $this->credentials = $credentials;
    }

    /**
     * @return SpacesLookup
     */
    public function lookup(): SpacesLookup {
        return new SpacesLookup($this->credentials);
    }
}
