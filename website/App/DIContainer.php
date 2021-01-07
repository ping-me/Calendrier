<?php
namespace App;

class DIContainer {
    private static $registry = array();

    public static function register($classPath) {
        $classFqn = substr($classPath, strpos($classPath, '\\'), strrpos($classPath, '.'));
        $classFile = substr($classFqn, strrpos($classFqn, '\\') + 1);
        $className = substr($classFile, 0, strrpos($classFile, '.'));
        static::$registry[$className] = substr($classFqn, 0, strrpos($classFqn, '.'));
    }

    public static function invoke($class, ...$params) {
        return new static::$registry[$class](...$params);
    }

    public static function showRegistryState() {
        var_dump(static::$registry);
    }
}
