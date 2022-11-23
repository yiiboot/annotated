<?php
/*
 * This file is part of the Yii Boot package.
 *
 * (c) niqingyang <niqy@qq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\Finder\Finder;
use Yiiboot\Annotated\AnnotationLoader;
use Yiisoft\Definitions\ReferencesArray;

/** @var array $params */
return [
    AnnotationLoader::class => [
        '__construct()' => [
            'paths' => $params['yiiboot/annotated']['paths'] ?? [],
            'handlers' => ReferencesArray::from($params['yiiboot/annotated']['handlers'] ?? [])
        ]
    ]
];
