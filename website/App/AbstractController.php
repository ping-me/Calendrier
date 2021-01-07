<?php
namespace App;
use Exception;

abstract class AbstractController {
    public $output;

    public function __construct($method, $params = null) {
        $this->output = '';
        try {
            switch ($method) {
                case 'POST':
                    $this->post($params);
                    break;
                case 'GET':
                    $this->get($params);
                    break;
                case 'PUT':
                    $this->put($params);
                    break;
                case 'DELETE':
                    $this->delete($params);
                    break;
                default:
                    // Méthode non prise en charge : on renvoie un 403 : Forbidden
                    http_response_code(403);
                    throw new Exception('Erreur : Requête interdite.');
                    break;
            }
        } catch(Exception $error) {
            die($error->getMessage());
        }

        // Affichage de la page
        echo $this->output;
    }

    /**
     * Fonction de réponse pour chaque méthode prise en charge.
     * Ce sont les méthodes qui doivent être overriden
     * si on veut prendre en charge la méthode
     * 
     * Par défaut GET renvoie 404 : Not Found
     * et POST, PUT et DELETE renvoient 405 : Method Not Allowed
     */
    public function post($params) {
        http_response_code(405);
        throw new Exception('Impossible de créer la resource demandée.');
    }

    public function get($params) {
        http_response_code(404);
        throw new Exception('Impossible de trouver la resource demandée.');
    }

    public function put($params) {
        http_response_code(405);
        throw new Exception('Impossible d\'éditer la resource demandée.');
    }

    public function delete($params) {
        http_response_code(405);
        throw new Exception('Impossible de supprimer la resource demandée.');
    }
}