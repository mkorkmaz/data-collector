<?php
declare(strict_types=1);

use PHPUG\Factory\Github as GithubFactory;
use PHPUG\Service\Github as GithubService;
use PHPUG\Factory\Twitter as TwitterFactory;
use PHPUG\Service\Twitter as TwitterService;

return [
    'dependencies' => [
        'factories' => [
            GithubService::class => GithubFactory::class,
            TwitterService::class => TwitterFactory::class
        ],
    ]
];