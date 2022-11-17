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

/**
 * the annotated class wrapper
 *
 * @author niqingyang<niqy@qq.com>
 * @date 2022/11/16 19:41
 */
final class AnnotatedClass implements AnnotatedInterface
{
    private ReflectionClass $class;
    private object $annotation;

    public function __construct(ReflectionClass $class, object $annotation)
    {
        $this->class = $class;
        $this->annotation = $annotation;
    }

    /**
     * get the annotated class
     *
     * @return ReflectionClass
     */
    public function getClass(): ReflectionClass
    {
        return $this->class;
    }

    /**
     * get the annotation object
     *
     * @return object
     */
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
