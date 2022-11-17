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

interface AnnotatedHandlerInterface
{
    /**
     * get the annotation is supported
     *
     * @param string $annotation
     * @return bool
     */
    public function support(string $annotation): bool;
}
