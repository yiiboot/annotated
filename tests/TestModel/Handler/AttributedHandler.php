<?php
/*
 * This file is part of the Yii Boot package.
 *
 * (c) niqingyang <niqy@qq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yiiboot\Attributed\Tests\TestModel\Handler;

use Yiiboot\Attributed\AbstractAttributedHandler;
use Yiiboot\Attributed\Tests\TestModel\Attribute\ClassAttribute;

class AttributedHandler extends AbstractAttributedHandler
{

    public array $attributes = [];

    public function getAnnotation(): string
    {
        return ClassAttribute::class;
    }

    public final function handle(array $attributeds): void
    {
        foreach ($attributeds as $attributed) {
            $this->attributes[] = $attributed->getAttributeClass();
        }
    }
}
