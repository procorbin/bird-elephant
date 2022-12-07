<?php

namespace Procorbin\BirdElephant\Compose;

/**
 *
 */
class Geo {

    public ?string $place_id = null;

    /**
     * @param $place_id
     * @return $this
     */
    public function placeId($place_id): Geo {
        $this->place_id = $place_id;
        return $this;
    }
}
