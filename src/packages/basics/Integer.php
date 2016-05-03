<?php

namespace Samshal\Rando\Packages\Basics;

use Samshal\Rando\Packages\PackageableInterface;
use Samshal\Rando\Packages\Packages;

class Integer extends Packages implements PackageableInterface
{

    protected $min;
    protected $max;

    public function setDefaults($defaultsArray = [])
    {
        $defaultsArray['min'] = -1 * mt_getrandmax();
        $defaultsArray['max'] = mt_getrandmax();

        return $defaultsArray;
    }

    protected function setMin($min)
    {
        $this->min = $min;
    }

    protected function setMax($max)
    {
        $this->max = $max;
    }

    private function generateDefaults()
    {
        if (empty($this->min)) {
            self::setMin($this->setDefaults()['min']);
        }

        if (empty($this->max)) {
            self::setMax($this->max = $this->setDefaults()['max']);
        }
    }
    private function generateInteger()
    {
        self::generateDefaults();

        return mt_rand($this->min, $this->max);
    }

    public function stringify()
    {
        return self::generateInteger();
    }
}
