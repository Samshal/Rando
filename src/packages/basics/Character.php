<?php

namespace Samshal\Rando\Packages\Basics;

use Samshal\Rando\Packages\PackageableInterface;
use Samshal\Rando\Packages\Packages;
use Samshal\Rando\Rando;

class Character extends Packages implements PackageableInterface
{

    protected $pool;
    protected $alpha;
    protected $casing;
    protected $symbols;

    private $lowerAlphs = 'abcdefghijklmnopqrstuvwxyz';
    private $upperAlphs = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    private $numbers = '0123456789';
    private $specialChars = '!@#$%^&*()';

    public function setDefaults()
    {
        $defaultsArray['pool'] = $this->lowerAlphs.$this->upperAlphs.$this->numbers.$this->specialChars;

        return $defaultsArray;
    }

    protected function setPool($pool)
    {
        $this->pool = $pool;
    }

    protected function setAlpha($boolean)
    {
        $this->alpha = $boolean;
    }

    protected function setCasing($casing)
    {
        $this->casing = $casing;
    }

    protected function setSymbols($boolean)
    {
        $this->symbols = $boolean;
    }

    private function generatePool()
    {
        if (!empty($this->symbols)) {
            $this->pool = $this->specialChars;
            return;
        }

        if (!empty($this->casing)) {
            if ($this->casing == 'upper') {
                $this->pool = $this->upperAlphs;
            } elseif ($this->casing == 'lower') {
                $this->pool = $this->lowerAlphs;
            }

            return;
        }

        if (!empty($this->alpha)) {
            $this->pool = $this->upperAlphs.$this->lowerAlphs;
            return;
        }

        return;
    }

    private function doRandomization()
    {
        self::generatePool();
        $characters = str_split($this->pool);
        $character = $characters[array_rand($characters)];

        return $character;
    }

    public function stringify()
    {
        return self::doRandomization();
    }
}
