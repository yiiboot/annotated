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

use Yiiboot\Annotated\AnnotatedClass;
use Yiiboot\Annotated\AnnotatedClassHandlerInterface;
use Yiiboot\Annotated\AnnotatedMethod;
use Yiiboot\Annotated\AnnotatedMethodHandlerInterface;
use Yiiboot\Annotated\AnnotatedProperty;
use Yiiboot\Annotated\AnnotatedPropertyHandlerInterface;

class AttributeHandler implements AnnotatedClassHandlerInterface, AnnotatedMethodHandlerInterface, AnnotatedPropertyHandlerInterface
{

    public array $attributes = [];

    public function handle(AnnotatedClass|AnnotatedProperty|AnnotatedMethod $annotated): void
    {
        $this->attributes[] = $annotated->getAnnotationClass();
    }

    public function support(string $annotation): bool
    {
        return true;
    }
}
