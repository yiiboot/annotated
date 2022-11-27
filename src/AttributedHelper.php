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

use Generator;
use ReflectionClass;

class AttributedHelper
{
    /**
     * Find all classes with given attribute.
     *
     * @param ReflectionClass $class
     *
     * @param string|null $attribute
     * @return Generator|AttributedClass[]
     * @psalm-suppress ArgumentTypeCoercion
     */
    public static function findClasses(ReflectionClass $class, string $attribute = null): Generator
    {
        foreach ($class->getAttributes($attribute) as $classAttribute) {
            yield new AttributedClass($class, $classAttribute->newInstance());
        }
    }

    /**
     * Find all methods with given attribute.
     *
     * @param ReflectionClass $class
     *
     * @param string|null $attribute
     * @return Generator|AttributedMethod[]
     * @psalm-suppress ArgumentTypeCoercion
     */
    public static function findMethods(ReflectionClass $class, string $attribute = null): Generator
    {
        foreach ($class->getMethods() as $method) {
            foreach ($method->getAttributes($attribute) as $methodAttribute) {
                yield new AttributedMethod($method, $methodAttribute->newInstance());
            }
        }
    }

    /**
     * Find all properties with given attribute.
     *
     * @param ReflectionClass $class
     *
     * @param string|null $attribute
     * @return Generator|AttributedProperty[]
     * @psalm-suppress ArgumentTypeCoercion
     */
    public static function findProperties(ReflectionClass $class, string $attribute = null): Generator
    {
        foreach ($class->getProperties() as $property) {
            foreach ($property->getAttributes($attribute) as $propertyAttribute) {
                yield new AttributedProperty($property, $propertyAttribute->newInstance());
            }
        }
    }
}
