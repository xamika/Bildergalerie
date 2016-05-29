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
    if (isset($_REQUEST['delete']) && isset($_REQUEST['img_id'])) {
        db_delete_image($_REQUEST['img_id'], getSessionValue('benutzerId'));
    }
    $gallery_id = $_GET['nr'];
    setSessionValue('galery_id', $gallery_id);
    setValue('galery_id', $gallery_id);
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
    setValue('galery_id', getSessionValue('galery_id'));
    setValue('phpmodule', $_SERVER['PHP_SELF']."?id=".__FUNCTION__);
    return runTemplate( "../templates/add_images.htm.php" );
}

function show_image() {
    if (isset($_REQUEST['img_id']) && isset($_REQUEST['nr'])) {
        setValue('image', db_select_image($_REQUEST['img_id'], getSessionValue('benutzerId')));
        setValue('phpmodule', $_SERVER['PHP_SELF']."?id=".__FUNCTION__);
        return runTemplate( "../templates/show_image.htm.php" );
    } else {

    }
}
