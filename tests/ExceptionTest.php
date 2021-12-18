<?php

namespace Typomedia\Exeinfo\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;
use Typomedia\Exeinfo\Exeinfo;

/**
 * Class ExeinfoTest
 * @package Typomedia\Exeinfo\Tests
 */
class ExceptionTest extends TestCase
{
    public function testFailures()
    {
        $this->expectException(\RuntimeException::class);

        $path = __DIR__ . '/Failures';
        $finder = new Finder();
        $finder->files()->in($path);

        foreach ($finder as $file) {
            $exeinfo = new Exeinfo($file);
            echo $exeinfo->product;
        }
    }

}
