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
use Symfony\Component\Finder\Finder;
use Yiiboot\Annotated\AnnotationScanner;
use Yiiboot\Annotated\Tests\TestModel\Attribute\ClassAttribute;
use Yiiboot\Annotated\Tests\TestModel\Attribute\MethodAttribute;
use Yiiboot\Annotated\Tests\TestModel\Attribute\PropertyAttribute;
use Yiiboot\Annotated\Tests\TestModel\Handler\AttributeHandler;

class AnnotationScannerTest extends TestCase
{
    public function testScan()
    {
        $scanner = new AnnotationScanner();

        $handler = new AttributeHandler();
        $scanner->addAnnotatedClassHandler('book', $handler);
        $scanner->addAnnotatedMethodHandler('book', $handler);
        $scanner->addAnnotatedPropertyHandler('book', $handler);

        $finder = Finder::create()->files()->in(__DIR__ .'/TestModel')->name('*.php');

        $scanner->scan($finder);

        $this->assertContains(ClassAttribute::class, $handler->attributes);
        $this->assertContains(MethodAttribute::class, $handler->attributes);
        $this->assertContains(PropertyAttribute::class, $handler->attributes);
    }
}
