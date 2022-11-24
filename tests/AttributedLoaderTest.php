<?php
/*
 * This file is part of the Yii Boot package.
 *
 * (c) niqingyang <niqy@qq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yiiboot\Attributed\Tests;

use PHPUnit\Framework\TestCase;
use Yiiboot\Attributed\AttributedLoader;
use Yiiboot\Attributed\Tests\TestModel\Attribute\ClassAttribute;
use Yiiboot\Attributed\Tests\TestModel\Handler\AttributedHandler;

class AttributedLoaderTest extends TestCase
{
    public function testScan()
    {
        $handler = new AttributedHandler();

        $loader = new AttributedLoader([
            __DIR__ . '/TestModel'
        ], [
            $handler
        ]);

        $time = microtime(true);

        $loader->load();

        echo (microtime(true) - $time) * 1000 . "\n";

        $this->assertContains(ClassAttribute::class, $handler->attributes);
    }
}
