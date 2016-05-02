<?php

namespace Samshal\Rando\Packages;

interface PackageableInterface
{

    public function stringify();

    public function initializeParameters($paramsArray);

    public function setDefaults();
}
