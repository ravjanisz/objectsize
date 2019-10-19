<?php

use PHPUnit\Framework\TestCase;
use Rav\ObjectSize\FileSize;
use Rav\ObjectSize\ObjectSizeException;

class FileSizeTest extends TestCase {

    public function testInvalidPath1() {
        $fileSize = new FileSize();
        $this->expectException(ObjectSizeException::class);

        $fileSize->inBytes(2);
    }

    public function testInvalidPath2() {
        $fileSize = new FileSize();
        $this->expectException(ObjectSizeException::class);

        $fileSize->inBytes('.');
    }

    public function testInvalidPath3() {
        $fileSize = new FileSize();
        $this->expectException(ObjectSizeException::class);

        $fileSize->inBytes(__DIR__ . '/assets/dir');
    }

    public function testSize() {
        $fileSize = new FileSize();

        $this->assertEquals(4, $fileSize->inBytes(__DIR__ . '/assets/test.txt'));
    }
}