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

interface AnnotatedHandlerInterface
{
    public function getAnnotation(): string;

    public function getTarget(): int;

    /**
     * handle the AnnotatedClass
     *
     * @param AnnotatedClass|AnnotatedMethod|AnnotatedProperty $annotated
     * @return void
     */
    public function handle(AnnotatedClass|AnnotatedMethod|AnnotatedProperty $annotated): void;

    /**
     * flush something after handle all
     *
     * @return void
     */
    public function flush(): void;
}
