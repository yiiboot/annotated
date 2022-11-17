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

use Spiral\Tokenizer\ClassLocator;
use Symfony\Component\Finder\Finder;

/**
 * scan the annotation and handle
 *
 * @author niqingyang<niqy@qq.com>
 * @date 2022/11/17 23:03
 */
class AnnotationScanner
{
    /**
     * @var array<string, AnnotatedClassHandlerInterface|callable>
     */
    private array $classHandlers = [];

    /**
     * @var array<string, AnnotatedMethodHandlerInterface|callable>
     */
    private array $methodHandlers = [];

    /**
     * @var array<string, AnnotatedPropertyHandlerInterface|callable>
     */
    private array $propertyHandlers = [];

    public function __construct()
    {
    }

    /**
     * scan the annotation by finder
     *
     * @param Finder $finder
     * @param string|null $annotation
     * @return void
     */
    public function scan(Finder $finder, string $annotation = null): void
    {
        if (empty($this->classHandlers) && empty($this->methodHandlers) && empty($this->propertyHandlers)) {
            return;
        }

        $classLocator = new ClassLocator($finder);

        $loader = new AnnotationLoader($classLocator);

        foreach ($loader->findClasses($annotation) as $annotatedClass) {

            if ($annotatedClass->getClass()->isAbstract()) {
                continue;
            }

            $this->handleAnnotatedClass($annotatedClass);

            foreach ($loader->findMethods($annotation, $annotatedClass->getClass()) as $annotatedMethod) {
                $this->handleAnnotatedMethod($annotatedMethod);
            }

            foreach ($loader->findProperties($annotation, $annotatedClass->getClass()) as $annotatedProperty) {
                $this->handleAnnotatedProperty($annotatedProperty);
            }
        }
    }

    public function addAnnotatedClassHandler(string $name, AnnotatedClassHandlerInterface|callable $handler): void
    {
        $this->classHandlers[$name] = $handler;
    }

    public function removeAnnotatedClassHandler(string $name): void
    {
        unset($this->classHandlers[$name]);
    }

    public function hasAnnotatedClassHandler(string $name): bool
    {
        return isset($this->classHandlers[$name]);
    }

    public function addAnnotatedMethodHandler(string $name, AnnotatedMethodHandlerInterface|callable $handler): void
    {
        $this->methodHandlers[$name] = $handler;
    }

    public function removeAnnotatedMethodHandler(string $name): void
    {
        unset($this->methodHandlers[$name]);
    }

    public function hasAnnotatedMethodHandler(string $name): bool
    {
        return isset($this->methodHandlers[$name]);
    }

    public function addAnnotatedPropertyHandler(string $name, AnnotatedPropertyHandlerInterface|callable $handler): void
    {
        $this->propertyHandlers[$name] = $handler;
    }

    public function removeAnnotatedPropertyHandler(string $name): void
    {
        unset($this->propertyHandlers[$name]);
    }

    public function hasAnnotatedPropertyHandler(string $name): bool
    {
        return isset($this->propertyHandlers[$name]);
    }

    private function handleAnnotatedClass(AnnotatedClass $annotatedClass): void
    {
        $this->handleAnnotatedTarget($this->classHandlers, $annotatedClass);
    }

    private function handleAnnotatedMethod(AnnotatedMethod $annotatedMethod): void
    {
        $this->handleAnnotatedTarget($this->methodHandlers, $annotatedMethod);
    }

    private function handleAnnotatedProperty(AnnotatedProperty $annotatedProperty): void
    {
        $this->handleAnnotatedTarget($this->propertyHandlers, $annotatedProperty);
    }

    private function handleAnnotatedTarget(array $handlers, AnnotatedClass|AnnotatedMethod|AnnotatedProperty $annotatedTarget): void
    {
        $annotation = $annotatedTarget->getAnnotationClass();

        if ($annotation === \Attribute::class) {
            return;
        }

        foreach ($handlers as $name => $handler) {
            if (is_callable($handler)) {
                call_user_func($handler, $name, $annotatedTarget);
            } else if ($handler instanceof AnnotatedHandlerInterface) {
                if ($name === '*' || $handler->support($annotation)) {
                    $handler->handle($annotatedTarget);
                }
            }
        }
    }
}
