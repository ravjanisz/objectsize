<?php

namespace Rav\ObjectSize;

class FileSize implements Size {

    public function inBytes($file) {
        if (!file_exists($file)) {
            throw new ObjectSizeException("File '$file' not exists.");
        }

        if (!is_file($file)) {
            throw new ObjectSizeException("'$file' is not a file.");
        }

        return filesize($file);
    }
}