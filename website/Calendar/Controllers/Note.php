<?php
namespace Calendar\Controllers;
use App\AbstractController;
use App\DIContainer as dc;

class Note extends AbstractController {
    public function post($params) {
        // Appel pour création/édition d'une note
        dc::invoke('Notepad')->createNote(...$params);
    }

    public function put($params) {
        // Appel pour affichage de la modale
        if (count($params) < 4) {
            array_push($params, '');
        }
        $nmd = dc::invoke('NoteModalData');
        $nmd->setDate(...$params);
        dc::invoke('NoteModal')->render($nmd);
    }

    public function delete($params) {
        // Appel pour suppression d'une note
        dc::invoke('Notepad')->deleteNote(...$params);
    }
}