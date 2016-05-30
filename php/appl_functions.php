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
function galeries()
{
    if (isset($_REQUEST['delete']) && isset($_REQUEST['galery_id'])) {
        check_galery_access($_REQUEST['galery_id'], getSessionValue('user_id'));
        db_delete_galery($_REQUEST['galery_id'], getSessionValue('user_id'));
        redirect('galeries');
    }
    setValue('galery', db_select_galery(getSessionValue('user_id')));
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/galeries.htm.php");
}

function check_galery_access($galery_id, $user_id)
{
    if (isset(db_select_users_galery($galery_id, $user_id)[0])) {
        return true;
    } else {
        addMessage("danger", "Du hast keine Berechtigung");
        redirect('galeries');
    }
}

function galery()
{
    check_galery_access(getRequestParam('galery_id'), getSessionValue('user_id'));
    if (isset($_REQUEST['delete']) && isset($_REQUEST['img_id'])) {
        db_delete_image($_REQUEST['img_id'], getSessionValue('user_id'));
        redirect('galery', ['galery_id' => getRequestParam('galery_id')]);
    }
    $gallery_id = getRequestParam('galery_id');
    setValue('galery_id', $gallery_id);
    setValue('images', db_select_galery_images($gallery_id, getSessionValue("user_id")));
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/galery.htm.php");
}

function galery_create()
{
    if (isset($_POST['save'])) {
        if (empty($_POST['name'])) {
            addMessage('danger', 'Sie müssen einen Namen angeben');
        } else {
            $db_result = db_insert_galery($_POST['name'], getSessionValue("user_id"));
            addMessage('success', 'Fotogalerie wurde erfolgreich erstelt');
            redirect('image_add', ['galery_id' => $db_result[0]['id']]);
        }
    }
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/galery_create.htm.php");
}

function image_add()
{
    check_galery_access(getRequestParam('galery_id'), getSessionValue('user_id'));
    setValue('galery_id', getRequestParam('galery_id'));
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/image_add.htm.php");
}

function image_show()
{
    check_galery_access(getRequestParam('galery_id'), getSessionValue('user_id'));
    if (isset($_REQUEST['img_id']) && isset($_REQUEST['galery_id'])) {
        setValue('image', db_select_image($_REQUEST['img_id'], getSessionValue('user_id')));
        setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
        return runTemplate("../templates/image_show.htm.php");
    } else {

    }
}
