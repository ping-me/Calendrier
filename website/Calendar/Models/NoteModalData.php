<?php
namespace Calendar\Models;
use Calendar\Data\DateUtils as du;
use App\DIContainer as dc;

class NoteModalData {
    public $noteContent;
    public $selectedDay;
    public $selectedMonth;
    public $selectedYear;
    public $dateHeader;
    public $createNoteParams;
    public $isEditMode;


    public function setDate($year, $month, $day) {
        $this->selectedYear = $year;
        $this->selectedMonth = $month;
        $this->selectedDay = $day;
        $this->dateHeader = du::$days[du::getWeekDayNumber($year, $month, $day)] . ' ' . $day . ' ' . du::$months[$month] . ' ' . $year;
        $this->createNoteParams = $year . ', ' . $month . ', ' . $day;
        $this->noteContent = '';
        $this->isEditMode = dc::invoke('Notepad')->hasNote($year, $month, $day);
        if ($this->isEditMode) {
            $this->noteContent = dc::invoke('Notepad')->getNote($year, $month, $day);
        }    
    }
}
