<?php
declare(strict_types=1);

namespace PHPUG\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use PHPUG\Service\Github as GithubService;

class Github implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : GithubService
    {
        $config = $container->get('config');
        return new GithubService($config['github']);
    }
}
