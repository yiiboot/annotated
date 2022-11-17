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
 * the AnnotatedClass handler
 *
 * @author niqingyang<niqy@qq.com>
 * @date 2022/11/17 22:53
 */
interface AnnotatedClassHandlerInterface extends AnnotatedHandlerInterface
{
    /**
     * handle the AnnotatedClass
     *
     * @param AnnotatedClass $annotatedClass
     * @return void
     */
    public function handle(AnnotatedClass $annotatedClass): void;
}
