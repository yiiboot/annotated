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

/**
 * the annotated class wrapper
 *
 * @author niqingyang<niqy@qq.com>
 * @date 2022/11/16 19:41
 */
final class AnnotatedClass
{
    private ReflectionClass $class;
    private ReflectionAttribute $annotation;

    public function __construct(ReflectionClass $class, ReflectionAttribute $annotation)
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
     * @return ReflectionAttribute
     */
    public function getAnnotation(): ReflectionAttribute
    {
        return $this->annotation;
    }
}
