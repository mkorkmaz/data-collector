<?php
declare(strict_types=1);

namespace PHPUG\Service;

use GuzzleHttp\Client;

class Github
{
    private $githubClient;

    public function __construct(array $githubConfig)
    {
        $this->githubClient = new Client([
            'base_uri' => 'https://api.github.com/graphql',
            'headers' => [
                'User-Agent' => 'PHPUG-Client/1.0',
                'Accept' => 'application/json',
                'Content-Type' => 'application/json;charset=utf-8',
                'Authorization' => 'bearer ' . $githubConfig['token']
            ]
        ]);
    }

    public function getTeamMembers(string $organizationName) : array
    {
        $query = '
        query {
              organization(login: "%s") {
                name
                members(first:50) {
                  nodes {
                    name,
                    login,
                    avatarUrl,
                    location,
                    bio,
                    bioHTML
                  }
                }
              }
            }
        ';
        return $this->request(sprintf($query, $organizationName));
    }

    /**
     * @param string $query
     * @param string $variables
     * @return array
     * @throws \RuntimeException
     */
    private function request(string $query, string $variables = '') : array
    {
        $payload = ['query' => trim($query), 'variables' => trim($variables)];
        $response = $this->githubClient->post('', [
            'json' => $payload
        ]);
        $body = $response->getBody();
        return json_decode($body->getContents(), (bool) JSON_OBJECT_AS_ARRAY);
    }
}
