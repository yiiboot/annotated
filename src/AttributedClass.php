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

/**
 * the Attributed class wrapper
 *
 * @author niqingyang<niqy@qq.com>
 * @date 2022/11/16 19:41
 */
final class AttributedClass implements AttributedInterface
{
    private ReflectionClass $class;
    private object $attribute;

    public function __construct(ReflectionClass $class, object $attribute)
    {
        $this->class = $class;
        $this->attribute = $attribute;
    }

    /**
     * get the Attributed class
     *
     * @return ReflectionClass
     */
    public function getClass(): ReflectionClass
    {
        return $this->class;
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
