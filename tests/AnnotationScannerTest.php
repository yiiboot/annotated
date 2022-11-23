<?php
/*
 * This file is part of the Yii Boot package.
 *
 * (c) niqingyang <niqy@qq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yiiboot\Annotated\Tests;

use PHPUnit\Framework\TestCase;
use Yiiboot\Annotated\AnnotationLoader;
use Yiiboot\Annotated\Tests\TestModel\Attribute\ClassAttribute;
use Yiiboot\Annotated\Tests\TestModel\Handler\AttributeHandler;

class AnnotationScannerTest extends TestCase
{
    public function testScan()
    {
        $handler = new AttributeHandler();

        $loader = new AnnotationLoader([
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
