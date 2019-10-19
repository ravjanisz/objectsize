<?php

namespace Rav\ObjectSize;

use Rav\Size\SizeSettings;
use Rav\Size\Size as HumanSize;

abstract class ObjectBase {

    /** @var $object Size */
    protected $object;
    protected $humanSize;
    protected $path;

    public function __construct(SizeSettings $settings) {
        $this->humanSize = new HumanSize($settings);
    }

    public function human() {
        if (!$this->object) {
            throw new ObjectSizeException('Not initialized path.');
        }

        $bytes = $this->object->inBytes($this->path);

        return $this->humanSize->human($bytes);
    }
}