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
use ReflectionMethod;

/**
 * the annotated method wrapper
 *
 * @author niqingyang<niqy@qq.com>
 * @date 2022/11/16 19:45
 */
final class AnnotatedMethod implements AnnotatedInterface
{
    private ReflectionMethod $method;
    private object $annotation;

    public function __construct(ReflectionMethod $method, object $annotation)
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

    public function getAnnotation(): object
    {
        return $this->annotation;
    }

    /**
     * get the annotation class
     *
     * @return string
     */
    public function getAnnotationClass(): string
    {
        return get_class($this->annotation);
    }
}
