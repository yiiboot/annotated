<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Yiiboot\Attributed\AttributedLoader;

return [
    // 启动时加载默认的加载器
    function (ContainerInterface $container) {
        $loader = $container->get(AttributedLoader::class);
        $loader->load();
    }
];
