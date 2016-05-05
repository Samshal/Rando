<?php

/*
 * This file is part of the samshal/rando package.
 *
 * (c) Samuel Adeshina <samueladeshina73@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Samshal\Rando;

/**
 * Generates several random data such as names, country, gender, numbers,
 * SSN and so on using the mt_rand implementation of mersenne twitter.
 * It can be used to supply randomly generated data during tests and placeholding.
 *
 * @since  1.0
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 */
class Rando
{
    /**
     * @var string
     * @access protected
     */
    protected static $packagesDirectory = __DIR__ . '/packages';

    /**
     * @var string
     * @access protected
     */
    protected static $commonNamespace = __NAMESPACE__.'\\Packages';

    /**
     * @var string
     * @access protected
     */
    protected static $commonInterface = 'Samshal\\Rando\\Packages\\PackageableInterface';

    /**
     * Magic method for calling packages, treats supplied package methods
     * as methods and retrieves their __toString values 
     *
     * @access public
     * @return string
     */
    public function __call($method, $parameters)
    {
        return self::processInstruction($method, $parameters);
    }

    /**
     * Magic method for calling static packages. A variation of the __call magic
     * method
     *
     * @access public
     * @return string
     */
    public static function __callStatic($method, $parameters)
    {
        return self::processInstruction($method, $parameters);
    }

    /**
     * @param $method string
     * @param $parameters array
     *
     * Performs the instantiation of a class and returns 
     * the generated random string value
     *
     * @access public
     * @return string
     */
    private static function processInstruction($method, $parameters)
    {
        $parameters = isset($parameters[0]) ? $parameters[0] : [];
        $class = self::instantiatePackage($method);
        return self::getRandoString($class, $parameters);
    }

    /**
     * @param $packageName string
     *
     * Searches the directories containing package namespaces 
     * for the $packageName parameter and then returns an instance
     * of the class when it finds it or throws an exception if it cant be found.
     *
     * @access private
     * @return PackagesInterface instance
     * @throws Samshal\Rando\Exceptions\RequestedClassNotFoundExcption
     */
    private static function instantiatePackage($packageName)
    {
        $namespaceDirectories = glob(self::$packagesDirectory.'/*', GLOB_ONLYDIR);
        $packageName = ucfirst(strtolower($packageName));
        foreach ($namespaceDirectories as $namespaceDirectory) {
            $baseName = basename($namespaceDirectory);
            $namespace = self::$commonNamespace.'\\'.ucfirst(strtolower($baseName));
            $class = $namespace.'\\'.$packageName;
            if (class_exists($class)) {
                return new $class;
            }
        }
        throw new Exceptions\RequestedClassNotFoundException();
    }

    /**
     * @param class PackagesInterface
     * @param parameter array
     *
     * Returns a randomly generated string
     *
     * @access private
     * @return string
     * @throws Samshal\Rando\Exceptions\InterfaceNotImplementedException
     */
    private static function getRandoString($class, $parameters)
    {
        $implementedInterfaces = class_implements($class);
        if (!in_array(self::$commonInterface, $implementedInterfaces)) {
            throw new Exceptions\InterfaceNotImplementedException();
        } else {
            $class->initializeParameters($parameters);
            return $class->stringify();
        }
    }
}
