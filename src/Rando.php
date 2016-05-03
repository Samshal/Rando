<?php
namespace Samshal\Rando;

class Rando
{

    protected static $packagesDirectory = __DIR__ . '/packages';
    protected static $commonNamespace = __NAMESPACE__.'\\Packages';
    protected static $commonInterface = 'Samshal\\Rando\\Packages\\PackageableInterface';

    public function __call($method, $parameters)
    {
        return self::processInstruction($method, $parameters);
    }

    public static function __callStatic($method, $parameters)
    {
        return self::processInstruction($method, $parameters);
    }

    private static function processInstruction($method, $parameters)
    {
        $parameters = isset($parameters[0]) ? $parameters[0] : [];
        $class = self::instantiatePackage($method);
        return self::getRandoString($class, $parameters);
    }

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

        return;
    }

    private static function getRandoString($class, $parameters)
    {
        $implementedInterfaces = class_implements($class);
        if (!in_array(self::$commonInterface, $implementedInterfaces)) {
            throw new Exceptions\InterfaceNotImplementedException();
        } else {
            $class->initializeParameters($parameters);
            return $class->stringify();
        }

        return;
    }
}
