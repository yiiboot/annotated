<?php
/*
 * This file is part of the Yii Boot package.
 *
 * (c) niqingyang <niqy@qq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yiiboot\Annotated\Tests\TestModel\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class PropertyAttribute
{
    public function __construct(public string $name = 'property attribute')
    {
    }
}
