<?php
declare(strict_types=1);

namespace PHPUG\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use PHPUG\Service\Twitter as TwitterService;

class Twitter implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : TwitterService
    {
        $config = $container->get('config');
        return new TwitterService($config['twitter']);
    }
}
