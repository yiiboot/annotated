<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Yiiboot\Annotated\AnnotationLoader;

return [
    // 启动时加载默认的加载器
    function (ContainerInterface $container) {
        $loader = $container->get(AnnotationLoader::class);
        $loader->load();
    }
];
