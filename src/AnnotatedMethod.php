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

use ReflectionAttribute;
use ReflectionClass;
use ReflectionMethod;

/**
 * the annotated method wrapper
 *
 * @author niqingyang<niqy@qq.com>
 * @date 2022/11/16 19:45
 */
final class AnnotatedMethod
{
    private ReflectionMethod $method;
    private ReflectionAttribute $annotation;

    public function __construct(ReflectionMethod $method, ReflectionAttribute $annotation)
    {
        $this->method = $method;
        $this->annotation = $annotation;
    }

    public function getClass(): ReflectionClass
    {
        return $this->method->getDeclaringClass();
    }

    public function getMethod(): ReflectionMethod
    {
        return $this->method;
    }

    public function getAnnotation(): ReflectionAttribute
    {
        return $this->annotation;
    }
}
