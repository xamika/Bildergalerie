<?php
/*
 *  @autor Michael Abplanalp
 *  @version 1.0
 *
 *  Dieses Modul beinhaltet Funktionen, welche die Anwendungslogik implementieren.
 *
 */

/*
 * Gibt die entsprechende CSS-Klasse aus einem assiziativen Array (key: Name Eingabefeld) zurück.
 * Wird im Template aufgerufen.
 *
 * @param   $name       Name des Eingabefeldes
 */
function getCssClass( $name ) {
    global $css_classes;
    if (isset($css_classes[$name])) return $css_classes[$name];
    else return getValue('cfg_css_class_normal');
}

/*
 * Beinhaltet die Anwendungslogik zur Anzeige und zum Bearbeiten von allen Fotoalben
 */
function fotoalben() {
    // Template abfüllen und Resultat zurückgeben
    setValue('fotoalbum', db_select_fotogalerien(getSessionValue('benutzerId')));
    setValue('phpmodule', $_SERVER['PHP_SELF']."?id=".__FUNCTION__);
    return runTemplate( "../templates/fotoalben.htm.php" );
}

function fotoalbum() {
    $gallery_id = $_GET['nr'];
    setValue('images', db_select_fotogalerie_images($gallery_id, getSessionValue("benutzerId")));
    setValue('phpmodule', $_SERVER['PHP_SELF']."?id=".__FUNCTION__);
    return runTemplate( "../templates/fotoalbum.htm.php" );
}

function create_fotoalbum() {
    if (isset($_POST['save'])) {
        if (empty($_POST['name'])) {
            addMessage('danger', 'Sie müssen einen Namen angeben');
        } else {
            $db_result = db_insert_fotogalerie($_POST['name'], getSessionValue("benutzerId"));
            addMessage('success', 'Fotogalerie wurde erfolgreich erstelt');
            setSessionValue('galery_id', $db_result[0]['id']);
            redirect('add_images');
        }
    }
    setValue('phpmodule', $_SERVER['PHP_SELF']."?id=".__FUNCTION__);
    return runTemplate( "../templates/create_fotoalbum.htm.php" );
}

function add_images() {
    setValue('phpmodule', $_SERVER['PHP_SELF']."?id=".__FUNCTION__);
    return runTemplate( "../templates/add_images.htm.php" );
}
?>
