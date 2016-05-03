<?php

namespace Samshal\Rando\Packages\Basics;

use Samshal\Rando\Packages\PackageableInterface;
use Samshal\Rando\Packages\Packages;
use Samshal\Rando\Rando;

class String extends Packages implements PackageableInterface
{

    protected $pool;
    protected $minLength;
    protected $maxLength;
    protected $length;

    public function setDefaults($defaultsArray = [])
    {
        $defaultsArray['minLength'] = 5;
        $defaultsArray['maxLength'] = 20;

        return $defaultsArray;
    }

    protected function setPool($pool)
    {
        $this->pool = $pool;
    }

    protected function setMinLength($min)
    {
        $this->minLength = $min;
    }

    protected function setMaxLength($max)
    {
        $this->maxLength = $max;
    }

    protected function setLength($length)
    {
        $this->length = $length;
    }

    private function doRandomization()
    {
        $length = (!empty($this->length)) ? $this->length : Rando::integer(['min'=>$this->minLength, 'max'=>$this->maxLength]);
        $string = '';
        while ($length > 0) {
            if (empty($this->pool)) {
                $string .= Rando::character();
            } else {
                $string .= Rando::character(['pool'=>$this->pool]);
            }

            $length--;
        }

        return $string;
    }

    public function stringify()
    {
        return self::doRandomization();
    }
}
