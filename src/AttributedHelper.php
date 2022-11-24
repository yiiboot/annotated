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
     * Find all classes with given annotation.
     *
     * @param ReflectionClass $class
     *
     * @param string|null $annotation
     * @return Generator|AttributedClass[]
     * @psalm-suppress ArgumentTypeCoercion
     */
    public static function findClasses(ReflectionClass $class, string $annotation = null): Generator
    {
        foreach ($class->getAttributes($annotation) as $classAnnotation) {
            yield new AttributedClass($class, $classAnnotation->newInstance());
        }
    }

    /**
     * Find all methods with given annotation.
     *
     * @param ReflectionClass $class
     *
     * @param string|null $annotation
     * @return Generator|AttributedMethod[]
     * @psalm-suppress ArgumentTypeCoercion
     */
    public static function findMethods(ReflectionClass $class, string $annotation = null): Generator
    {
        foreach ($class->getMethods() as $method) {
            foreach ($method->getAttributes($annotation) as $methodAnnotation) {
                yield new AttributedMethod($method, $methodAnnotation->newInstance());
            }
        }
    }

    /**
     * Find all properties with given annotation.
     *
     * @param ReflectionClass $class
     *
     * @param string|null $annotation
     * @return Generator|AttributedProperty[]
     * @psalm-suppress ArgumentTypeCoercion
     */
    public static function findProperties(ReflectionClass $class, string $annotation = null): Generator
    {
        foreach ($class->getProperties() as $property) {
            foreach ($property->getAttributes($annotation) as $propertyAnnotation) {
                yield new AttributedProperty($property, $propertyAnnotation->newInstance());
            }
        }
    }
}
