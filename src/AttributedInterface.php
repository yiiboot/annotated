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
 * get the attributed class
 *
 * @author niqingyang<niqy@qq.com>
 * @date 2022/11/17 23:44
 */
interface AttributedInterface
{
    /**
     * get the Attributed class
     *
     * @return ReflectionClass
     */
    public function getClass(): ReflectionClass;

    /**
     * get the attribute class
     *
     * @return string
     */
    public function getAttributeClass(): string;

    /**
     * get the attribute object
     *
     * @return object
     */
    public function getAttribute(): object;
}
