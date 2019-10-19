<?php

namespace Rav\ObjectSize;

use \RecursiveIteratorIterator;
use \RecursiveDirectoryIterator;

class DirectorySize implements Size {

    public function inBytes($path) {
        if (!file_exists($path)) {
            throw new ObjectSizeException("Directory '$path' not exists.");
        }

        if (!is_dir($path)) {
            throw new ObjectSizeException("'$path' is not a directory.");
        }

        $size = 0;
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $file) {
            if ($file->getFilename() == '..') {
                continue;
            }

            if ($file->isLink() and !file_exists($file->getPathname())) {
                continue;
            }

            $size += $file->getSize();
        }

        return $size;
    }
}