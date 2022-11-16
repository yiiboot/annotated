<?php
/*
 * This file is part of the Yii Boot package.
 *
 * (c) niqingyang <niqy@qq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yiiboot\Annotated;

use ReflectionClass;
use ReflectionProperty;

/**
 * the annotated property wrapper
 *
 * @author niqingyang<niqy@qq.com>
 * @date 2022/11/16 19:46
 */
final class AnnotatedProperty
{
    private ReflectionProperty $property;
    private object $annotation;

    public function __construct(ReflectionProperty $property, object $annotation)
    {
        $this->property = $property;
        $this->annotation = $annotation;
    }

    public function getClass(): ReflectionClass
    {
        return $this->property->getDeclaringClass();
    }

    public function getProperty(): ReflectionProperty
    {
        return $this->property;
    }

    public function getAnnotation(): object
    {
        return $this->annotation;
    }
}
