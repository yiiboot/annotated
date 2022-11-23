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

use Generator;
use ReflectionClass;

class AnnotatedHelper
{
    /**
     * Find all classes with given annotation.
     *
     * @param ReflectionClass $class
     *
     * @param string|null $annotation
     * @return Generator|AnnotatedClass[]
     * @psalm-suppress ArgumentTypeCoercion
     */
    public static function findClasses(ReflectionClass $class, string $annotation = null): Generator
    {
        foreach ($class->getAttributes($annotation) as $classAnnotation) {
            yield new AnnotatedClass($class, $classAnnotation->newInstance());
        }
    }

    /**
     * Find all methods with given annotation.
     *
     * @param ReflectionClass $class
     *
     * @param string|null $annotation
     * @return Generator|AnnotatedMethod[]
     * @psalm-suppress ArgumentTypeCoercion
     */
    public static function findMethods(ReflectionClass $class, string $annotation = null): Generator
    {
        foreach ($class->getMethods() as $method) {
            foreach ($method->getAttributes($annotation) as $methodAnnotation) {
                yield new AnnotatedMethod($method, $methodAnnotation->newInstance());
            }
        }
    }

    /**
     * Find all properties with given annotation.
     *
     * @param ReflectionClass $class
     *
     * @param string|null $annotation
     * @return Generator|AnnotatedProperty[]
     * @psalm-suppress ArgumentTypeCoercion
     */
    public static function findProperties(ReflectionClass $class, string $annotation = null): Generator
    {
        foreach ($class->getProperties() as $property) {
            foreach ($property->getAttributes($annotation) as $propertyAnnotation) {
                yield new AnnotatedProperty($property, $propertyAnnotation->newInstance());
            }
        }
    }
}
