<?php

namespace Typomedia\Exeinfo\Tests;

use PHPUnit\Framework\TestCase;
use Typomedia\Exeinfo\Exeinfo;

/**
 * Class ExeinfoTest
 * @package Typomedia\Exeinfo\Tests
 */
class ExeinfoTest extends TestCase
{
    protected $exeinfo;

    public function testProduct()
    {
        $file = __DIR__ . '/Fixtures/test.exe';

        $exeinfo = new Exeinfo($file);
        $product = $exeinfo->product;

        $this->assertEquals('Test Application', $product);
    }

    public function testCompany()
    {
        $file = __DIR__ . '/Fixtures/test.exe';

        $exeinfo = new Exeinfo($file);
        $company = $exeinfo->company;

        $this->assertEquals('Typomedia Foundation', $company);
    }

    public function testCopyright()
    {
        $file = __DIR__ . '/Fixtures/test.exe';

        $exeinfo = new Exeinfo($file);
        $copyright = $exeinfo->copyright;

        $this->assertEquals('Copyright 2021 Typomedia Foundation', $copyright);
    }

    public function testDescription()
    {
        $file = __DIR__ . '/Fixtures/test.exe';

        $exeinfo = new Exeinfo($file);
        $description = $exeinfo->description;

        $this->assertEquals('Test Application for demonstration', $description);
    }

    public function testVersion()
    {
        $file = __DIR__ . '/Fixtures/test.exe';

        $exeinfo = new Exeinfo($file);
        $version = $exeinfo->version;

        $this->assertEquals('1.2.3', $version);
    }

    public function testComments()
    {
        $file = __DIR__ . '/Fixtures/test.exe';

        $exeinfo = new Exeinfo($file);
        $comment = $exeinfo->comment;

        $this->assertEquals('A test comment', $comment);
    }
}
