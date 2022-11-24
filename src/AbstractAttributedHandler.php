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

use Attribute;
use ReflectionClass;

/**
 * the abstract AttributedHandler
 *
 * @author niqingyang<niqy@qq.com>
 * @date 2022/11/18 00:52
 */
abstract class AbstractAttributedHandler implements AttributedHandlerInterface
{
    private ?int $target = null;

    public final function getTarget(): int
    {
        if ($this->target === null) {
            $class = new ReflectionClass($this->getAnnotation());
            foreach ($class->getAttributes(Attribute::class) as $attribute) {
                $attribute = $attribute->newInstance();
                $this->target = $attribute->flags;
                break;
            }
        }
        return $this->target;
    }

    public function flush(): void
    {
        // TODO: Implement after() method.
    }
}
