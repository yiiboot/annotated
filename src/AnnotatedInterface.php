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

/**
 * get the annotation class
 *
 * @author niqingyang<niqy@qq.com>
 * @date 2022/11/17 23:44
 */
interface AnnotatedInterface
{
    /**
     * get the annotation class
     *
     * @return string
     */
    public function getAnnotationClass(): string;
}
