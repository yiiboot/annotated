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
use Spiral\Tokenizer\ClassesInterface;

/**
 * the annotation loader
 *
 * @author niqingyang<niqy@qq.com>
 * @date 2022/11/16 19:47
 */
final class AnnotationLoader
{
    private ClassesInterface $classLocator;
    private array $targets = [];

    public function __construct(ClassesInterface $classLocator)
    {
        $this->classLocator = $classLocator;
    }

    /**
     * the classes
     *
     * @param string[]|array $targets
     * @return $this
     */
    public function withTargets(array $targets): self
    {
        $new = clone $this;
        $new->targets = $targets;

        return $new;
    }

    /**
     * Find all classes with given annotation.
     *
     * @param string $annotation
     * @param ReflectionClass|null $class
     *
     * @return AnnotatedClass[]|Generator
     * @psalm-suppress ArgumentTypeCoercion
     */
    public function findClasses(string $annotation, ?ReflectionClass $class = null): Generator
    {
        if ($class !== null) {
            foreach ($class->getAttributes($annotation) as $classAnnotation) {
                yield new AnnotatedClass($class, $classAnnotation->newInstance());
            }
        }
        foreach ($this->getTargets() as $target) {
            foreach ($target->getAttributes($annotation) as $classAnnotation) {
                yield new AnnotatedClass($target, $classAnnotation->newInstance());
            }
        }
    }

    /**
     * Find all methods with given annotation.
     *
     * @param string $annotation
     * @param ReflectionClass|null $class
     *
     * @return AnnotatedMethod[]|Generator
     * @psalm-suppress ArgumentTypeCoercion
     */
    public function findMethods(string $annotation, ?ReflectionClass $class = null): Generator
    {
        if ($class !== null) {
            foreach ($class->getMethods() as $method) {
                foreach ($method->getAttributes($annotation) as $methodAnnotation) {
                    yield new AnnotatedMethod($method, $methodAnnotation->newInstance());
                }
            }
            return;
        }
        foreach ($this->getTargets() as $target) {
            foreach ($target->getMethods() as $method) {
                foreach ($method->getAttributes($annotation) as $methodAnnotation) {
                    yield new AnnotatedMethod($method, $methodAnnotation->newInstance());
                }
            }
        }
    }

    /**
     * Find all properties with given annotation.
     *
     * @param string $annotation
     * @param ReflectionClass|null $class
     *
     * @return AnnotatedProperty[]|Generator
     * @psalm-suppress ArgumentTypeCoercion
     */
    public function findProperties(string $annotation, ?ReflectionClass $class = null): Generator
    {
        if ($class !== null) {
            foreach ($class->getProperties() as $property) {
                foreach ($property->getAttributes($annotation) as $propertyAnnotation) {
                    yield new AnnotatedProperty($property, $propertyAnnotation->newInstance());
                }
            }
            return;
        }
        foreach ($this->getTargets() as $target) {
            foreach ($target->getProperties() as $property) {
                foreach ($property->getAttributes($annotation) as $propertyAnnotation) {
                    yield new AnnotatedProperty($property, $propertyAnnotation->newInstance());
                }
            }
        }
    }

    /**
     * @return ReflectionClass[]|Generator
     */
    private function getTargets(): Generator
    {
        if ($this->targets === []) {
            yield from $this->classLocator->getClasses();
            return;
        }

        foreach ($this->targets as $target) {
            yield from $this->classLocator->getClasses($target);
        }
    }
}
