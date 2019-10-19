# objectsize

[![Build Status](https://travis-ci.org/ravjanisz/objectsize.svg?branch=master)](https://travis-ci.org/ravjanisz/objectsize)
[![codecov](https://codecov.io/gh/ravjanisz/objectsize/branch/master/graph/badge.svg)](https://codecov.io/gh/ravjanisz/objectsize)

Converts file or directory to human readable number by taking the number of that unit that the bytes will go into it.

## Requirements

* PHP >= 7.1
* ravjanisz/readablesize
* (optional) PHPUnit to run tests.

## Install

Via Composer:

```bash
$ composer require ravjanisz/objectsize
```
## Usage

```PHP
//settings and object instance
use Rav\Size\SizeSettings;
use Rav\ObjectSize\ObjectSize;

//create settings for human readable size
$settings = new SizeSettings();
$settings->setPrecision(2);

//create object instance
$object = new ObjectSize($settings);
//set file/dir path
$object->setPath(__DIR__ . '/files/shark.jpeg');
//get value
echo $object->human();
//get value in bytes
echo $object->inBytes();

//set file/dir path
$object->setPath(__DIR__ . '/files');
//get value
echo $object->human();
//get value in bytes
echo $object->inBytes();
```

## Documentation

None

## Support the development

**Do you like this project? Support it by donating**

<a href="https://www.buymeacoffee.com/ravjanisz">

![alt Buy me a coffee](https://raw.githubusercontent.com/ravjanisz/objectsize/master/docs/assets/bmc.png)

</a>

## License

objectsize is licensed under the MIT License - see the LICENSE file for details 
