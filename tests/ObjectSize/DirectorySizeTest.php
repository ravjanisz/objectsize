<?php

use PHPUnit\Framework\TestCase;
use Rav\ObjectSize\DirectorySize;
use Rav\ObjectSize\ObjectSizeException;

class DirectorySizeTest extends TestCase {

    public function testInvalidPath1() {
        $dirSize = new DirectorySize();
        $this->expectException(ObjectSizeException::class);

        $dirSize->inBytes(2);
    }

    public function testInvalidPath() {
        $dirSize = new DirectorySize();
        $this->expectException(ObjectSizeException::class);

        $dirSize->inBytes(__DIR__ . '/assets/test.txt');
    }

    public function testSize() {
        $dirSize = new DirectorySize();

        $this->assertEquals(4096 + (14 + 9), $dirSize->inBytes(__DIR__ . '/assets/dir'));
        $this->assertEquals(4096 + (4096 + (14 + 9)) + 4096 + 4, $dirSize->inBytes(__DIR__ . '/assets'));
    }
}