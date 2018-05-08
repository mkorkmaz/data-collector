<?php
namespace PHPUGTests;

use PHPUG\Service\Github;

class GithubGetTeamMembersTest extends \Codeception\Test\Unit
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
    public function getGithubMembers() : void
    {
        $githubService = new Github($this->config['github']);
        $members = $githubService->getTeamMembers('php-ug');
        $this->assertArrayHasKey('data', $members, 'Service returned undesired response');
        $this->assertArrayHasKey(
            'organization',
            $members['data'],
            'Service returned undesired response for data'
        );
        $this->assertArrayHasKey(
            'name',
            $members['data']['organization'],
            'Service returned undesired response for organization'
        );
        $this->assertEquals(
            'PHP-UG',
            $members['data']['organization']['name'],
            'Service returned wrong organization name, probably test changed for another organization'
        );
    }
}