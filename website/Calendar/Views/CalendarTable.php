<?php
namespace Calendar\Views;
use Calendar\Data\DateUtils as du;
use App\DIContainer as dc;

class CalendarTable {
    public function render($data) {
        $cellView = dc::invoke('CalendarCell');
        $cellData = dc::invoke('CalendarCellData');
        ?>
        <table class="table table-striped text-center col-10 offset-1">
            <thead>
                <tr>
                <?php
                // Ecriture du header avec le nom des jours
                foreach (du::$days as $dayName) {
                    ?>
                    <th><?= $dayName; ?></th>
                <?php
                }
                ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php
                // Création du tableau
                // On rajoute d'abord les éventuelles cases vides pour se placer sur le premier jour du mois
                if($data->startDay > 1) {
                    for ($day = $data->previousMonthLastDay - $data->startDay + 2; $day <= $data->previousMonthLastDay; $day++) {
                        $cellData->setDate($data->previousYear, $data->previousMonth, $day)
                                 ->setClasses(true)
                                 ->setSaint($data->saints[$data->previousYear][$data->previousMonth][$day - 1]);
                        $cellView->render($cellData);
                    }
                }
                // Remplissage du calendrier
                while ($data->currentDay <= $data->daysInMonth) {
                    $cellData->setDate($data->selectedYear, $data->selectedMonth, $data->currentDay)
                             ->setClasses(false)
                             ->setSaint($data->saints[$data->selectedYear][$data->selectedMonth][$data->currentDay - 1]);
                    $cellView->render($cellData);
                    // On passe au jour suivant
                    $data->currentDay++;
                    $data->startDay++;
                    // Si on arrive à la fin de la semaine, on commence une nouvelle ligne
                    if ($data->startDay > 7) {
                        $data->startDay = 1;
                        ?>
                </tr>
                <tr>
                    <?php
                    }
                }
                // On termine la dernière ligne avec des cases vides si besoin
                if ($data->startDay > 1) {
                    for ($day = 1; $day <= 8 - $data->startDay; $day++) {
                        $cellData->setDate($data->nextYear, $data->nextMonth, $day)
                                 ->setClasses(true)
                                 ->setSaint($data->saints[$data->nextYear][$data->nextMonth][$day - 1]);
                        $cellView->render($cellData);
                    }
                }
                ?>
                </tr>
            </tbody>
        </table>
        <?php
    }
}
