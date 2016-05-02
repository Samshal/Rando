<?php

namespace Samshal\Rando\Packages\Basics;

use Samshal\Rando\Packages\PackageableInterface;
use Samshal\Rando\Packages\Packages;
use Samshal\Rando\Rando;
use Samshal\Rando\Exceptions\UnallowedLessThanZeroException;

class Natural extends Packages implements PackageableInterface
{

    protected $fixed;
    protected $min;
    protected $max;

    public function setDefaults()
    {
        $defaultsArray['min'] = 1;
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
            $this->min = $this->setDefaults()['min'];
        }

        if (empty($this->max)) {
            $this->max = $this->setDefaults()['max'];
        }
    }
    private function generateNatural()
    {
        self::generateDefaults();

        if ($this->min < 0) {
            throw new UnallowedLessThanZeroException();
        }
        return Rando::integer(['min'=>$this->min, 'max'=>$this->max]);
    }

    public function stringify()
    {
        return self::generateNatural();
    }
}
