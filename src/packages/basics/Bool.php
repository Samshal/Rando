<?php

namespace Samshal\Rando\Packages\Basics;

use Samshal\Rando\Packages\PackageableInterface;
use Samshal\Rando\Packages\Packages;

class Bool extends Packages implements PackageableInterface
{

    protected $likelihood;

    public function setDefaults()
    {
        $defaultsArray['likelihood'] = 50;

        return $defaultsArray;
    }

    protected function setLikelihood($likelihood)
    {
        $this->likelihood = $likelihood;
    }

    private function generateBooleans()
    {
        $successRatio = ($this->likelihood / 100) * 10;
        $failureRatio = 10 - $successRatio;

        $booleans = array_fill(0, $successRatio, (int)true);
        if ($successRatio !== 10) {
            $booleans = array_merge($booleans, array_fill($successRatio+1, $failureRatio, (int)false));
        }

        return $booleans;
    }

    private function doRandomization()
    {
        $booleans = self::generateBooleans();
        
        return (boolean)$booleans[array_rand($booleans)];
    }

    public function stringify()
    {
        return self::doRandomization();
    }
}
