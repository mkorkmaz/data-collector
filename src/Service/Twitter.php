<?php
declare(strict_types=1);

namespace PHPUG\Service;

use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter
{
    private $twitterClient;

    public function __construct(array $twitterConfig)
    {
        $this->twitterClient = new TwitterOAuth(
            $twitterConfig['consumer-key'],
            $twitterConfig['consumer-secret'],
            $twitterConfig['access-token'],
            $twitterConfig['access-token-secret']
        );
    }

    public function getLatestTweets(string $twitterHandle) : array
    {
        $statuses = $this->twitterClient->get('statuses/user_timeline', [
            'screen_name' => $twitterHandle,
            'count' => 5,
            'exclude_replies' => true,
            'include_rts' => false
        ]);
        return $statuses;
    }
}
