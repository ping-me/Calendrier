<?php
namespace Calendar\Controllers;
use App\AbstractController;
use App\DIContainer as dc;

class Calendar extends AbstractController {
    public function get($params) {
        // Appel pour affichage du calendrier
        $ctd = dc::invoke('CalendarTableData');
        $ctd->setDate(...$params);
        dc::invoke('CalendarSelector')->render($ctd);
        dc::invoke('CalendarTable')->render($ctd);
    }
}