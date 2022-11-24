<?php
/*
 * This file is part of the Yii Boot package.
 *
 * (c) niqingyang <niqy@qq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Yiiboot\Attributed\AttributedLoader;
use Yiisoft\Definitions\ReferencesArray;

/** @var array $params */
return [
    AttributedLoader::class => [
        '__construct()' => [
            'paths' => $params['yiiboot/attributed']['paths'] ?? [],
            'handlers' => ReferencesArray::from($params['yiiboot/attributed']['handlers'] ?? [])
        ]
    ]
];
