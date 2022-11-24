<?php
/*
 * This file is part of the Yii Boot package.
 *
 * (c) niqingyang <niqy@qq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yiiboot\Attributed\Tests\TestModel\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class MethodAttribute
{
    public function __construct(public string $name = 'method attribute')
    {
    }
}
