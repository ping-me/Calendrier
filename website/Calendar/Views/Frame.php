<?php
namespace Calendar\Views;
use App\DIContainer as dc;

class Frame {
    public function render($data) {
        dc::invoke('Notepad');
        ?>
        <!doctype html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
            <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
            <title>PHP - Partie 9 - TP</title>
        </head>
        <body>
            <div class="container-fluid">
                <div class="row" id="form-container">
                <?php
                dc::invoke('CalendarForm')->render($data);
                ?>
                </div>
                <div class="row" id="calendar-container">
                <?php
                $ctd = dc::invoke('CalendarTableData');
                $ctd->setDate($data['selectedYear'], $data['selectedMonth']);
                dc::invoke('CalendarSelector')->render($ctd);
                dc::invoke('CalendarTable')->render($ctd);
                ?>
                </div>
            </div>
            <div class="modal fade" role="dialog" id="note-modal"></div>
            <script src="assets/js/jquery.js"></script>
            <script src="assets/js/bootstrap.js"></script>
            <script src="assets/js/XHRRequestor.js"></script>
            <script src="assets/js/main.js"></script>
        </body>
        </html>
        <?php
    }
}
