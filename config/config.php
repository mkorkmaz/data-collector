<?php
declare(strict_types=1);

use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\Glob;

$config = [];
foreach (Glob::glob(__DIR__ . '/autoload/{{,*.}global,{,*.}local}.php', Glob::GLOB_BRACE) as $file) {
    $config = ArrayUtils::merge($config, include $file);
}


return $config;
