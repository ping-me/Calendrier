<?php
namespace Calendar\Views;
use Calendar\Data\DateUtils as du;

class CalendarForm {
    public function render($data) {
        ?>
        <form class="container-fluid col-10 offset-1 text-center" method="post">
            <div class="row">
                <div class="col-2 form-group offset-4 text-center">
                    <label for="calMonth">Mois</label>
                    <select name="calMonth" id="calMonth" class="custom-select text-center">
                    <?php
                    // Boucle de création du dropdown pour les mois
                    foreach (du::$months as $monthIndex=>$month) {
                        ?>
                        <option value="<?= $monthIndex; ?>"<?= ($monthIndex == $data['selectedMonth']) ? ' selected="selected"' : ''; ?>><?= $month; ?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <div class="col-2 form-group text-center">
                    <label for="calYear">Année</label>
                    <select name="calYear" id="calYear" class="custom-select text-center">
                    <?php
                    // Boucle de création du dropdown pour les années
                    for ($year = 1970; $year <= 2050; $year++) {
                        ?>
                        <option value="<?= $year; ?>"<?= ($year == $data['selectedYear']) ? ' selected="selected"' : ''; ?>><?= $year; ?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
            </div>
        </form>
        <?php
    }
}
