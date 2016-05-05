<?php

/*
 * This file is part of the samshal/rando package.
 *
 * (c) Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Samshal\Rando\Packages;

interface PackageableInterface
{

    public function stringify();

    public function initializeParameters($paramsArray);

    public function setDefaults();
}
