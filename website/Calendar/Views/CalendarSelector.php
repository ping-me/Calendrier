<?php
namespace Calendar\Views;
use Calendar\Data\DateUtils as du;
use App\DIContainer as dc;

class CalendarSelector {
    public function render($data) {
        ?>
        <div class="col-10 offset-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2 offset-2 text-right d-flex align-items-end justify-content-end" id="previousMonthLabel" data-previous-month="<?= $data->previousMonth; ?>" data-previous-year="<?= $data->previousYear; ?>">
                        <h2><?= du::$months[$data->previousMonth] . ' ' . $data->previousYear; ?></h2>
                    </div>
                    <div class="col-4 text-center">
                        <h1 class="font-weight-bold"><?= du::$months[$data->selectedMonth] . ' ' . $data->selectedYear; ?></h1>
                    </div>
                    <div class="col-2 text-left d-flex align-items-end justify-content-start" id="nextMonthLabel" data-next-month="<?= $data->nextMonth; ?>" data-next-year="<?= $data->nextYear; ?>">
                        <h2><?= du::$months[$data->nextMonth] . ' ' . $data->nextYear; ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
