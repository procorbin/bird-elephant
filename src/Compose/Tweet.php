<?php

namespace Procorbin\BirdElephant\Compose;

use Exception;

class Tweet {

    public $direct_message_deep_link = null;
    public $for_super_followers_only = false;
    public $quote_tweet_id = null;
    public $reply_settings = null;
    public $text = null;
    public $media = null;
    public $poll = null;
    public $reply = null;
    public $geo = null;

    /**
     * @param $text
     * @return $this
     */
    public function text($text): Tweet {
        $this->text = $text;
        return $this;
    }

    /**
     * @param $geo
     * @return $this
     */
    public function geo($geo): Tweet {
        $this->geo = $geo;
        return $this;
    }

    /**
     * @param $media
     * @return $this
     * @throws Exception
     */
    public function media($media): Tweet {
        if ($this->poll !== null || $this->quote_tweet_id !== null) {
            throw new Exception('A tweet can only contain one of a poll, media or a quote tweet id.');
        }
        $this->media = $media;
        return $this;
    }

    /**
     * @param $poll
     * @return $this
     * @throws Exception
     */
    public function poll($poll): Tweet {
        if ($this->media !== null || $this->quote_tweet_id !== null) {
            throw new Exception('A tweet can only contain one of a poll, media or a quote tweet id.');
        }
        $this->poll = $poll;
        return $this;
    }

    /**
     * @param $reply
     * @return $this
     */
    public function reply($reply): Tweet {
        $this->reply = $reply;
        return $this;
    }

    public function replySettings($reply_settings): Tweet
    {
        $this->reply_settings = $reply_settings;
        return $this;
    }

    /**
     * @param $quote_tweet_id
     * @return $this
     * @throws Exception
     */
    public function quoteTweetId($quote_tweet_id): Tweet
    {
        if ($this->media !== null || $this->poll !== null) {
            throw new Exception('A tweet can only cotain one of a poll, media or a quote tweet id.');
        }
        $this->quote_tweet_id = $quote_tweet_id;
        return $this;
    }

    /**
     * @param bool $for_super_followers_only
     * @return $this
     */
    public function forSuperFollowersOnly(bool $for_super_followers_only = true): Tweet
    {
        $this->for_super_followers_only = $for_super_followers_only;
        return $this;
    }

    /**
     * @param $direct_message_deep_link
     * @return $this
     */
    public function directMessageDeepLink($direct_message_deep_link): Tweet
    {
        $this->direct_message_deep_link = $direct_message_deep_link;
        return $this;
    }

    /**
     * Add all non null properties to an array
     *
     * @return array
     */
    public function build(): array
    {
        $vars =  get_object_vars($this);
        $data = [];

        foreach ($vars as $key => $value) {
            if ($value !== null) {
                $data[$key] = $value;
            }
        }

        return $data;
    }
}
