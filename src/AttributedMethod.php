<?php
/*
 * This file is part of the Yii Boot package.
 *
 * (c) niqingyang <niqy@qq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yiiboot\Attributed;

use ReflectionClass;
use ReflectionMethod;

/**
 * the Attributed method wrapper
 *
 * @author niqingyang<niqy@qq.com>
 * @date 2022/11/16 19:45
 */
final class AttributedMethod implements AttributedInterface
{
    private ReflectionMethod $method;
    private object $attribute;

    public function __construct(ReflectionMethod $method, object $attribute)
    {
        $this->method = $method;
        $this->attribute = $attribute;
    }

    public function getMethod(): ReflectionMethod
    {
        return $this->method;
    }

    /**
     * get the Attributed class
     *
     * @return ReflectionClass
     */
    public function getClass(): ReflectionClass
    {
        return $this->method->getDeclaringClass();
    }

    /**
     * get the attribute object
     *
     * @return object
     */
    public function getAttribute(): object
    {
        return $this->attribute;
    }

    /**
     * get the attribute class
     *
     * @return string
     */
    public function getAttributeClass(): string
    {
        return get_class($this->attribute);
    }
}
