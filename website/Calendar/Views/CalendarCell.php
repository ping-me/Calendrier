<?php
namespace Calendar\Views;
use Calendar\Data\DateUtils as du;
use App\DIContainer as dc;

class CalendarCell {
    public function render($data) {
        ?>
        <td class="border<?= $data->class ? ' dark-cell' : ''; ?>">
            <h2 class="text-left <?= $data->class ? ' text-secondary' : ' text-primary'; ?><?= du::boldIfWeekend($data->year, $data->month, $data->day); ?>"><?= $data->day; ?></h2>
            <p><?= $data->saint; ?></p>
            <?php
            if ($data->isCurDayHoliday) {
                ?>
                <p class="text-info"><?= $data->isCurDayHoliday; ?></p>
                <?php
            }
            ?>
            <div class="note-actions">
            <?php
            if (dc::invoke('Notepad')->hasNote($data->year, $data->month, $data->day)) {
                ?>
                <img src="assets/img/note_edit.png" alt="Editer note" title="Editer note" onclick="openNoteEditor(<?= $data->jsParams; ?>);" />
                <img src="assets/img/note_delete.png" alt="Supprimer note" title="Supprimer note" onclick="deleteNote(<?= $data->jsParams; ?>);" />
                <?php
            } else {
                ?>
                <img src="assets/img/note_add.png" alt="Ajouter note" title="Ajouter note" onclick="openNoteEditor(<?= $data->jsParams; ?>);" />
                <?php
            }
            ?>
            </div>
        </td>
        <?php
    }
}
