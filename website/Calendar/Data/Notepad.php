<?php
namespace Calendar\Data;

class Notepad {
    private $notes;

    public function __construct() {
        if (!isset($_COOKIE['notes'])) {
            $this->initialiseNotes();
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        } else {
            $this->loadNotes();
        }
    }

    public function loadNotes() {
        $this->notes = unserialize($_COOKIE['notes']);
    }

    public function hasNote($year, $month, $day) {
        $hasNote = false;
        if (array_key_exists($year, $this->notes)) {
            if (array_key_exists($month, $this->notes[$year])) {
                if (array_key_exists($day, $this->notes[$year][$month])) {
                    $hasNote = true;
                }
            }
        }
        return $hasNote;
    }
    
    public function getNote($year, $month, $day) {
        return $this->notes[$year][$month][$day];
    }
    
    public function createNote($year, $month, $day, $note) {
        $this->notes[$year][$month][$day] = urldecode($note);
        $this->saveCookie();
    }
    
    public function deleteNote($year, $month, $day) {
        unset($this->notes[$year][$month][$day]);
        $this->saveCookie();
    }
    
    private function initialiseNotes() {
        $this->notes = array();
        $this->saveCookie();
    }

    private function saveCookie() {
        setcookie('notes', serialize($this->notes), time()+2592000, '/');
    }
}
