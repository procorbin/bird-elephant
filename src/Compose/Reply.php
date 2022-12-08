<?php

namespace Procorbin\BirdElephant\Compose;

class Reply {

    public $exclude_reply_user_ids = [];
    public $in_reply_to_tweet_id;

    /**
     * @param $exclude_reply_user_ids
     * @return $this
     */
    public function excludeReplyUserIds($exclude_reply_user_ids): Reply {
        $this->exclude_reply_user_ids = $exclude_reply_user_ids;
        return $this;
    }

    /**
     * @param $in_reply_to_tweet_id
     * @return $this
     */
    public function inReplyToTweetId($in_reply_to_tweet_id): Reply {
        $this->in_reply_to_tweet_id = $in_reply_to_tweet_id;
        return $this;
    }
}
