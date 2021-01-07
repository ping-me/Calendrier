<?php
namespace Calendar\Views;
use App\DIContainer as dc;

class NoteModal {
    public function render($data) {
        ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="noteTitle"><?= $data->isEditMode ? 'Editer' : 'Créer'; ?> une note</h4>
                    <h3><?= $data->dateHeader; ?></h3>
                </div>
                <div class="modal-body">
                    <textarea id="note-content-field"><?= $data->noteContent; ?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="save-button" title="<?= $data->isEditMode ? 'Editer' : 'Créer'; ?> la note" onclick="writeNote(<?= $data->createNoteParams; ?>, document.getElementById('note-content-field').value);"><?= $data->isEditMode ? 'Editer' : 'Créer'; ?></button>
                    <?php
                    if ($data->isEditMode) {
                        ?>
                        <button type="button" class="btn btn-danger" id="delete-button" title="Supprimer la note" onclick="deleteNote(<?= $data->createNoteParams; ?>);">Supprimer</button>
                        <?php
                    }
                    ?>
                    <button type="button" class="btn btn-secondary" id="cancel-button" title="Annuler" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
        <?php
    }
}
