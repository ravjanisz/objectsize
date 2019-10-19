<?php

namespace Rav\ObjectSize;

class ObjectSize extends ObjectBase {

    public function setPath($path) {
        switch (true) {
            case is_dir($path): $this->object = new DirectorySize(); break;
            case is_file($path): $this->object = new FileSize(); break;
            default: throw new ObjectSizeException('Invalid object type.');
        }

        $this->path = $path;
    }

    public function inBytes() {
        if (!$this->object) {
            throw new ObjectSizeException('Not initialized path.');
        }

        return $this->object->inBytes($this->path);
    }
}

// https://stackoverflow.com/questions/20045622/php-recursivedirectoryiterator
// php RecursiveDirectoryIterator
// php iterate over directory recursively with subfolders
// https://www.php.net/manual/en/class.recursivedirectoryiterator.php
// https://stackoverflow.com/questions/24783862/list-all-the-files-and-folders-in-a-directory-with-php-recursive-function