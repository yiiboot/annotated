<?php
/*
 * This file is part of the Yii Boot package.
 *
 * (c) niqingyang <niqy@qq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yiiboot\Annotated\Tests\TestModel\Handler;

use Yiiboot\Annotated\AbstractAnnotatedHandler;
use Yiiboot\Annotated\AnnotatedClass;
use Yiiboot\Annotated\AnnotatedMethod;
use Yiiboot\Annotated\AnnotatedProperty;
use Yiiboot\Annotated\Tests\TestModel\Attribute\ClassAttribute;

class AttributeHandler extends AbstractAnnotatedHandler
{

    public array $attributes = [];

    public function getAnnotation(): string
    {
        return ClassAttribute::class;
    }

    public final function handle(AnnotatedClass|AnnotatedMethod|AnnotatedProperty $annotated): void
    {
        $this->attributes[] = get_class($annotated->getAnnotation());
    }
}
