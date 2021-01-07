<?php
namespace Calendar\Models;
use Calendar\Data\Saints as saints;
use Calendar\Data\DateUtils as du;

class CalendarTableData {
    public $currentDay;
    public $startDay;
    public $daysInMonth;
    public $previousMonthLastDay;
    public $selectedYear;
    public $selectedMonth;
    public $previousYear;
    public $previousMonth;
    public $nextYear;
    public $nextMonth;
    public $saints;

    public function setDate($year, $month) {
        // Préparation des données à afficher pour le mois courant
        // Compteur pour le jour actuel à créer dans le calendrier
        $this->currentDay = 1;
        // Premier jour du mois courant
        $this->startDay = (int) du::getWeekDayNumber($year, $month);
        // Nombre de jours dans le mois
        $this->daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $this->selectedYear = $year;
        $this->selectedMonth = $month;

        // Mois précédent
        if($month == 1) {
            $this->previousMonth = 12;
            $this->previousYear = $year - 1;
        }
        else {
            $this->previousMonth = $month - 1;
            $this->previousYear = $year;
        }
        $this->previousMonthLastDay = cal_days_in_month(CAL_GREGORIAN, $this->previousMonth, $this->previousYear);

        // Mois suivant
        if($month == 12) {
            $this->nextMonth = 1;
            $this->nextYear = $year + 1;
        }
        else {
            $this->nextMonth = $month + 1;
            $this->nextYear = $year;
        }

        // Listes des saints
        $this->saints = array();
        $this->saints[$this->previousYear][$this->previousMonth] = saints::getSaintsFor($this->previousMonth);
        $this->saints[$year][$month] = saints::getSaintsFor($month);
        $this->saints[$this->nextYear][$this->nextMonth] = saints::getSaintsFor($this->nextMonth);
    }
}
