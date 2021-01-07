<?php
require_once('website/config.php');

spl_autoload_register(function($class) {
    $classpath = 'website\\' . $class . '.php';
    try {
        if (file_exists($classpath)) {
            require_once($classpath);
        } else {
            throw new Exception($classpath . ' : La classe n\'existe pas');
        }
    } catch (Exception $error) {
        die($error->getMessage());
    }
});

registerClassesIn('website');
//\App\DIContainer::showRegistryState();

App\DIContainer::invoke('Router')->start();

function registerClassesIn($dir) {
    $dirFiles = scandir($dir);
    foreach ($dirFiles as $class) {
        $fullPath = $dir . '\\' . $class;
        if (is_dir($fullPath)) {
            if ($class[0] != '.') {
                registerClassesIn($fullPath);
            }
        } else {
            App\DIContainer::register($fullPath);
        }
    }
}
