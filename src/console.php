<?php
declare(strict_types=1);
chdir(dirname(__DIR__));
require_once('vendor/autoload.php');
$config = require('config/config.php');
use Selami\Console\ApplicationFactory;
use Zend\ServiceManager\ServiceManager;

$container = new ServiceManager($config['dependencies']);
$container->setService('config', $config);
$container->setService('commands', $config['commands']);
$cli = ApplicationFactory::makeApplication($container);
$cli->run();
