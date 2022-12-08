<?php

namespace Procorbin\BirdElephant\Compose;

class Media {

    public $media_ids = null;
    public $tagged_user_ids = [];

    /**
     * @param $media_ids
     * @return $this
     */
    public function mediaIds($media_ids): Media {
        $this->media_ids = $media_ids;
        return $this;
    }

    /**
     * @param $tagged_user_ids
     * @return $this
     */
    public function taggedUserIds($tagged_user_ids): Media {
        $this->tagged_user_ids = $tagged_user_ids;
        return $this;
    }
}
