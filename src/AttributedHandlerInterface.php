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
 * Attribute handler
 *
 * @author niqingyang<niqy@qq.com>
 * @date 2022/11/27 20:09
 */
interface AttributedHandlerInterface
{
    /**
     * 判断是否支持
     *
     * @param ReflectionClass $class
     * @return bool
     */
    public function support(ReflectionClass $class): bool;

    /**
     * @return string
     */
    public function getAttribute(): string;

    /**
     * the attribute target
     *
     * @return int
     */
    public function getTarget(): int;

    /**
     * handle the AttributedClass
     *
     * @param AttributedInterface[] $attributeds
     * @return void
     */
    public function handle(array $attributeds): void;

    /**
     * flush something after handle all
     *
     * @return void
     */
    public function flush(): void;
}
