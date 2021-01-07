<?php
namespace Calendar\Data;

class DateUtils {
    public static $days = array(
        1=>'Lundi',
        2=>'Mardi',
        3=>'Mercredi',
        4=>'Jeudi',
        5=>'Vendredi',
        6=>'Samedi',
        7=>'Dimanche'
    );

    public static $months = array(
        1=>'Janvier',
        2=>'Février',
        3=>'Mars',
        4=>'Avril',
        5=>'Mai',
        6=>'Juin',
        7=>'Juillet',
        8=>'Août',
        9=>'Septembre',
        10=>'Octobre',
        11=>'Novembre',
        12=>'Décembre'
    );

    public static $holidays = array(
        1=>array(
            1=>'Jour de l\'an'
        ),
        5=>array(
            1=>'Fête du travail',
            8=>'Victoire de 1945'
        ),
        7=>array(
            14=>'Fête nationale'
        ),
        8=>array(
            15=>'Assomption'
        ),
        11=>array(
            1=>'Toussaint',
            11=>'Armistice'
        ),
        12=>array(
            25=>'Noel'
        )
    );

    /**
     * Permet de renvoyer le jour de la semaine sous forme numérale
     * de lundi = 1 à dimanche = 7
     * @param int $year Année du jour cible, équivalent de date('Y')
     * @param int $month Mois du jour cible, équivalent de date('n')
     * @param int $day Jour du mois pour le jour cible, équivalent de date('d'), 1 par défaut
     * @return int $weekdayNumber
     */
    public static function getWeekDayNumber($year, $month, $day = 1) {
        return date('N', strtotime($year . '-' . $month . '-' . $day . ' 0:0:0'));
    }

    /**
     * Détermine si c'est un jour de weekend
     * et renvoie le code HTML bootstrap nécessaire
     * @param int $year L'année du jour à vérifier, équivalent de date('Y')
     * @param int $month Le mois du jour à vérifier, équivalent de date('n')
     * @param int $day Le jour à vérifier, équivalent de date('d')
     * @return string $htmlContent
     */
    public static function boldIfWeekend($year, $month, $day) {
        $htmlContent = '';
        if (static::getWeekDayNumber($year, $month, $day) > 5) {
            $htmlContent = ' font-weight-bold';
        }
        return $htmlContent;
    }

    /**
     * Permet de déterminer si le jour demandé est férié
     * et retourne le nom de la fête le cas échéant.
     * Retourne false si jour non férié
     * @param int $year L'année du jour à vérifier, équivalent de date('Y')
     * @param int $month Le mois du jour à vérifier, équivalent de date('n')
     * @param int $day Le jour à vérifier, équivalent de date('d')
     * @return string|bool $dayIsHoliday
     */
    public static function isHoliday($year, $month, $day) {
        $dayIsHoliday = false;
        if (array_key_exists($month, static::$holidays)) {
            if (array_key_exists($day, static::$holidays[$month])) {
                $dayIsHoliday = static::$holidays[$month][$day];
            }
        }
        return $dayIsHoliday;
    }
}
