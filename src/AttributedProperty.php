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
use ReflectionProperty;

/**
 * the Attributed property wrapper
 *
 * @author niqingyang<niqy@qq.com>
 * @date 2022/11/16 19:46
 */
final class AttributedProperty implements AttributedInterface
{
    private ReflectionProperty $property;
    private object $attribute;

    public function __construct(ReflectionProperty $property, object $attribute)
    {
        $this->property = $property;
        $this->attribute = $attribute;
    }

    public function getProperty(): ReflectionProperty
    {
        return $this->property;
    }

    /**
     * get the Attributed class
     *
     * @return ReflectionClass
     */
    public function getClass(): ReflectionClass
    {
        return $this->property->getDeclaringClass();
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
