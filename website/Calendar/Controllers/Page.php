<?php
namespace Calendar\Controllers;
use App\AbstractController;
use App\DIContainer as dc;

class Page extends AbstractController {
    public function get($params) {
        dc::invoke('Frame')->render([
            'selectedYear'  => (int) date('Y'),
            'selectedMonth' => (int) date('n')]);
    }
}