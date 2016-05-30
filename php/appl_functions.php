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
function getCssClass($name)
{
    global $css_classes;
    if (isset($css_classes[$name])) return $css_classes[$name];
    else return getValue('cfg_css_class_normal');
}

/*
 * Beinhaltet die Anwendungslogik zur Anzeige und zum Bearbeiten von allen Fotoalben
 */
function fotoalben()
{
    if (isset($_REQUEST['delete']) && isset($_REQUEST['galery_id'])) {
        check_galery_access($_REQUEST['galery_id'], getSessionValue('benutzerId'));
        db_delete_fotogalerie($_REQUEST['galery_id'], getSessionValue('benutzerId'));
        redirect('fotoalben');
    }
    setValue('fotoalbum', db_select_fotogalerien(getSessionValue('benutzerId')));
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/fotoalben.htm.php");
}

function check_galery_access($galery_id, $user_id)
{
    if (isset(db_select_users_fotogalerien($galery_id, $user_id)[0])) {
        return true;
    } else {
        addMessage("danger", "Du hast keine Berechtigung");
        redirect('fotoalben');
    }
}

function fotoalbum()
{
    check_galery_access(getRequestParam('galery_id'), getSessionValue('benutzerId'));
    if (isset($_REQUEST['delete']) && isset($_REQUEST['img_id'])) {
        db_delete_image($_REQUEST['img_id'], getSessionValue('benutzerId'));
        redirect('fotoalbum', ['galery_id' => getRequestParam('galery_id')]);
    }
    $gallery_id = getRequestParam('galery_id');
    setValue('galery_id', $gallery_id);
    setValue('images', db_select_fotogalerie_images($gallery_id, getSessionValue("benutzerId")));
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/fotoalbum.htm.php");
}

function create_fotoalbum()
{
    if (isset($_POST['save'])) {
        if (empty($_POST['name'])) {
            addMessage('danger', 'Sie müssen einen Namen angeben');
        } else {
            $db_result = db_insert_fotogalerie($_POST['name'], getSessionValue("benutzerId"));
            addMessage('success', 'Fotogalerie wurde erfolgreich erstelt');
            redirect('add_images', ['galery_id' => $db_result[0]['id']]);
        }
    }
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/create_fotoalbum.htm.php");
}

function add_images()
{
    check_galery_access(getRequestParam('galery_id'), getSessionValue('benutzerId'));
    setValue('galery_id', getRequestParam('galery_id'));
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/add_images.htm.php");
}

function show_image()
{
    check_galery_access(getRequestParam('galery_id'), getSessionValue('benutzerId'));
    if (isset($_REQUEST['img_id']) && isset($_REQUEST['galery_id'])) {
        setValue('image', db_select_image($_REQUEST['img_id'], getSessionValue('benutzerId')));
        setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
        return runTemplate("../templates/show_image.htm.php");
    } else {

    }
}
