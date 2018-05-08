<?php
namespace PHPUGTests;

use PHPUG\Service\Twitter;

class TwitterGetLatestTweetsTest extends \Codeception\Test\Unit
{
    protected $config;

    protected function _before()
    {
        $this->config = require dirname(__DIR__) . '/config/autoload/local.php';
    }

    protected function _after()
    {
    }

    /**
     * @test
     */
    public function getLatestTweets() : void
    {
        $twitterService = new Twitter($this->config['twitter']);
        $tweets = $twitterService->getLatestTweets('php_ug');
        $this->assertArrayHasKey(0, $tweets, 'Service returned undesired response');
        $this->assertObjectHasAttribute(
            'user',
            $tweets[0],
            'Service returned undesired response for tweets response'
        );
        $this->assertObjectHasAttribute(
            'screen_name',
            $tweets[0]->user,
            'Service returned undesired response for tweet > user response'
        );
        $this->assertEquals(
            'php_ug',
            $tweets[0]->user->screen_name,
            'Service returned wrong organization name, probably test changed for another organization'
        );
    }
}