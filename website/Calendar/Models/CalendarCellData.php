<?php
namespace Calendar\Models;
use Calendar\Data\DateUtils as du;

class CalendarCellData {
    public $year;
    public $month;
    public $day;
    public $class;
    public $saint;
    public $jsParams;
    public $isCurDayHoliday;

    public function setDate($year, $month, $day) {
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
        $this->jsParams = "{$year}, {$month}, {$day}";
        $this->isCurDayHoliday = du::isHoliday($year, $month, $day);
        return $this;
    }

    public function setClasses($class) {
        $this->class = $class;
        return $this;
    }

    public function setSaint($saint) {
        $this->saint = $saint;
    }
}
