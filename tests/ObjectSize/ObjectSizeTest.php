<?php

use PHPUnit\Framework\TestCase;
use Rav\Size\SizeSettings;
use Rav\ObjectSize\ObjectSize;
use Rav\ObjectSize\ObjectSizeException;

class ObjectSizeTest extends TestCase {

    /** @var $size ObjectSize */
    private $size;
    private $symlink = __DIR__ . '/assets/link/symlink';
    private $brokenSymlink = __DIR__ . '/assets/link/brokenSymlink';

    protected function setUp():void {
        $this->removeSymlink($this->symlink);
        symlink(__DIR__ . '/assets/dir/test.txt', $this->symlink);

        $this->removeSymlink($this->brokenSymlink);
        try {
            symlink(__DIR__ . '/assets/link/test11.txt', $this->brokenSymlink);
        } catch (Exception $e) { }

        $settings = new SizeSettings();
        $settings->setPrecision(2);

        $this->size = new ObjectSize($settings);
    }

    public function testInvalid1() {
        $this->expectException(ObjectSizeException::class);
        $this->size->inBytes(2);
    }

    public function testInvalid2() {
        $this->expectException(ObjectSizeException::class);
        $this->size->inBytes('');
    }

    public function testInvalidNotInitializedPath1() {
        $this->expectException(ObjectSizeException::class);
        $this->size->inBytes(__DIR__ . '/assets/test.txt');
    }

    public function testInvalidNotInitializedPath2() {
        $this->expectException(ObjectSizeException::class);
        $this->size->human(__DIR__ . '/assets/test.txt');
    }

    public function testSize() {
        $this->size->setPath(__DIR__ . '/assets/test.txt');
        $this->assertEquals(4, $this->size->inBytes());

        $this->size->setPath(__DIR__ . '/assets/dir');
        $this->assertEquals(4096 + (14 + 9), $this->size->inBytes());

        $this->size->setPath(__DIR__ . '/assets');
        $this->assertEquals(4096 + (4096 + (14 + 9)) + 4096 + (9) + 4, $this->size->inBytes());

        $this->assertEquals('12.04KiB', $this->size->human());

        $this->size->setPath($this->symlink);
        $this->assertEquals(9, $this->size->inBytes());

        $this->expectException(ObjectSizeException::class);
        $this->size->setPath($this->brokenSymlink);
        $this->size->inBytes();
    }

    protected function tearDown():void {
        $this->removeSymlink($this->symlink);
        $this->removeSymlink($this->brokenSymlink);
    }

    private function removeSymlink($symlink) {
        if(is_link($symlink) and file_exists($symlink)) {
            unlink($symlink);
        }
    }
}