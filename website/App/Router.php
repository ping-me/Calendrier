<?php
namespace App;
use App\DIContainer as dc;

class Router {
    private static $uri;
    private static $method;

    private static $controller;

    public static function start() {
        static::$uri = $_SERVER['REQUEST_URI'];
        static::$method = $_SERVER['REQUEST_METHOD'];

        $request = explode('/', static::$uri);
        
        // On enlève les éléments vides
        $request = array_filter($request);

        if (count($request)) {
            // On extrait le premier élément de la requête : la resource demandée
            $resource = array_shift($request);

            if (array_key_exists($resource, $GLOBALS['Routes'])) {
                // Si la resource existe, on charge le contrôleur associé
                static::$controller = dc::invoke($GLOBALS['Routes'][$resource], static::$method, $request);
            } else {
                // Resource inconnue
                // @todo Devrait renvoyer vers un controleur d'erreur ou de redirection,
                // pour maintenant on servira la raçine du site
                static::$controller = dc::invoke($GLOBALS['WebsiteDefault'], 'GET', $request);
            }
        } else {
            // Aucune resource demandée : l'URI est vide donc on affiche la page d'accueil
            static::$controller = dc::invoke($GLOBALS['WebsiteRoot'], 'GET', []);
        }
    }
}
