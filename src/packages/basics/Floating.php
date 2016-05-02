<?php

namespace Samshal\Rando\Packages\Basics;

use Samshal\Rando\Packages\PackageableInterface;
use Samshal\Rando\Packages\Packages;

class Floating extends Packages implements PackageableInterface
{

    protected $fixed;
    protected $min;
    protected $max;

    public function setDefaults()
    {
        $defaultsArray['fixed'] = 4;
        $defaultsArray['min'] = 0;
        $defaultsArray['max'] = mt_getrandmax();

        return $defaultsArray;
    }

    protected function setFixed($fixed)
    {
        $this->fixed = $fixed;
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
        if (empty($this->fixed)) {
            $this->fixed = $this->setDefaults()['fixed'];
        }

        if (empty($this->min)) {
            $this->min = $this->setDefaults()['min'];
        }

        if (empty($this->max)) {
            $this->max = $this->setDefaults()['max'];
        }
    }
    private function generateFloatNumber()
    {
        self::generateDefaults();
        
        $scale = pow(10, $this->fixed);
        return mt_rand($this->min, $this->max) / $scale;
    }

    public function stringify()
    {
        return self::generateFloatNumber();
    }
}
