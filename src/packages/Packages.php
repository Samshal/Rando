<?php

namespace Samshal\Rando\Packages;

use Samshal\Rando\Exceptions\ArrayParametersExpectedException;
use Samshal\Rando\Exceptions\OptionNotSupportedException;

abstract class Packages
{

    public function initializeParameters($parameters = [])
    {
        if (!is_array($parameters)) {
            throw new ArrayParametersExpectedException();
        }

        if (empty($parameters)) {
            $this->initializeParameters($this->setDefaults());
        }

        foreach ($parameters as $parameter=>$value) {
            $paramSetter = 'set'.ucfirst(strtolower($parameter));
            if (method_exists($this, $paramSetter)) {
                $this->$paramSetter($value);
            } else {
                throw new OptionNotSupportedException();
            }
        }
    }

    abstract public function stringify();
}
