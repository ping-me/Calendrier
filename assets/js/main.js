let xhr = new XMLHttpRequest();
let calendarContainer = document.getElementById('calendar-container');
let noteModal = document.getElementById('note-modal');
let yearList = document.getElementById('calYear');
let monthList = document.getElementById('calMonth');
yearList.addEventListener('change', updateCalendar);
monthList.addEventListener('change', updateCalendar);
setPrevNextMonths();

/**
 * Met à jour le calendrier affiché
 * en appelant loadCalendar()
 */
function updateCalendar() {
    loadCalendar(document.getElementById('calYear').value, document.getElementById('calMonth').value);
}

/**
 * Fonction de mise à jour du calendrier
 * @param year Année pour laquelle le calendrier sera chargé
 * @param month Mois pour lequel le calendrier sera chargé
 */
function loadCalendar(year, month) {
    yearList.value = year;
    monthList.value = month;
    XHRRequestor.httpGet(loadCalendarContent, 'calendar', year, month);
}

/**
 * Fonction d'ouverture de l'éditeur de note
 * La modale sera générée en fonction des paramètres d'entrée
 * @param year Année pour laquelle la note sera attribuée
 * @param month Mois pour lequel la note sera attribuée
 * @param day Jour pour lequel la note sera attribuée
 */
function openNoteEditor(year, month, day) {
    XHRRequestor.httpPut(openModal, 'note', year, month, day);
}

/**
 * Fonction d'écriture d'une note
 * @param year Année pour laquelle la note sera créée
 * @param month Mois pour lequel la note sera créée
 * @param day Jour pour lequel la note sera créée
 * @param note Le contenu de la note à créer
 */
function writeNote(year, month, day, note) {
    XHRRequestor.httpPost(closeModal, 'note', year, month, day, note);
}

/**
 * Fonction de suppression d'une note
 * @param year Année de la note à supprimer
 * @param month Mois de la note à supprimer
 * @param day Jour de la note à supprimer
 */
function deleteNote(year, month, day) {
    XHRRequestor.httpDelete(noteDelComplete, 'note', year, month, day);
}

/**
 * Fonctions callback
 * @todo devrait prendre en charge les message d'erreurs 
 */

/**
 * Fonction callback appelée lorsqu'une requete GET est terminée
 * @param xhr L'objet XMLHTTPRequest contenant la réponse
 */
function loadCalendarContent(xhr) {
    if (xhr.status == 200) {
        calendarContainer.innerHTML = xhr.responseText;
        setPrevNextMonths();
    }
}

/**
 * Fonction callback appelée lorsqu'une requete PUT est terminée
 * @param xhr L'objet XMLHTTPRequest contenant la réponse
 */
function openModal(xhr) {
    if (xhr.status == 200) {
        noteModal.innerHTML = xhr.responseText;
        $('#note-modal').modal('show');
    }
}

/**
 * Fonction callback appelée lorsqu'une requete POST est terminée
 * @param xhr L'objet XMLHTTPRequest contenant la réponse (inutilisé)
 */
function closeModal(xhr) {
    if (xhr.status == 200) {
        updateCalendar();
        $('#note-modal').modal('hide');
    }
}

/**
 * Fonction callback appelée lorsqu'une requete DELETE est terminée
 * @param xhr L'objet XMLHTTPRequest contenant la réponse (inutilisé)
 */
function noteDelComplete(xhr) {
    if (xhr.status == 200) {
        updateCalendar();
        $('#note-modal').modal('hide');
    }
}

/**
 * Place les écouteurs sur le sélecteur de mois
 */
function setPrevNextMonths() {
    previousMonthLabel = document.getElementById('previousMonthLabel');
    nextMonthLabel = document.getElementById('nextMonthLabel');
    previousYear = previousMonthLabel.dataset.previousYear;
    previousMonth = previousMonthLabel.dataset.previousMonth;
    nextYear = nextMonthLabel.dataset.nextYear;
    nextMonth = nextMonthLabel.dataset.nextMonth;
    previousMonthLabel.addEventListener('click', () => loadCalendar(previousYear, previousMonth));
    nextMonthLabel.addEventListener('click', () => loadCalendar(nextYear, nextMonth));
}
