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
 * Beinhaltet die Anwendungslogik zur Anzeige Löschen aller Fotoalben
 */
function galeries()
{
    if (isset($_REQUEST['delete']) && isset($_REQUEST['galery_id'])) {
        check_galery_access($_REQUEST['galery_id'], getSessionValue('user_id'));
        db_delete_galery($_REQUEST['galery_id'], getSessionValue('user_id'));
        redirect('galeries');
    }
    setValue('galery', db_select_galeries(getSessionValue('user_id')));
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/galeries.htm.php");
}

/*
 * Überprüft ob ein User Berechtigt ist diese Galery anzuzeigen oder zu bearbeiten
 */
function check_galery_access($galery_id, $user_id)
{
    if (db_select_users_galery($galery_id, $user_id)) {
        return true;
    } else {
        addMessage("danger", "Du hast keine Berechtigung");
        redirect('galeries');
    }
}

/*
 * Beinhaltet die Anwendungslogik um alle Bilder einer Galery anzuzeigen und einzele Bilder zu löschen
 */
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

/*
 * Beinhaltet die Anwendungslogik zum erstellen einer Galery
 */
function galery_create()
{
    if (isset($_POST['save'])) {
        if (empty($_POST['name'])) {
            addMessage('danger', 'Sie müssen einen Namen angeben');
        } elseif (!preg_match("/^[a-zA-Z0-9_.\-@!#$%&;'*+ ]*$/", $_POST['name'])) {
            addMessage('danger', 'Sie haben ein unerlaubtes Zeichen eingegeben. Erlaubte Zeichen:  a-z A-Z 0-9 _.-@!#$%&;\'*+');
        } else {
            $db_result = db_insert_galery($_POST['name'], getSessionValue("user_id"));
            addMessage('success', 'Fotogalerie wurde erfolgreich erstelt');
            redirect('image_add', ['galery_id' => $db_result[0]['id']]);
        }
    }
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/galery_create.htm.php");
}

/*
 * Beinhaltet die Anwendungslogik zum bearbeiten einer Galery
 */
function galery_update()
{
    check_galery_access($_REQUEST['galery_id'], getSessionValue('user_id'));
    setValue('galery', db_select_galery($_REQUEST['galery_id'], getSessionValue('user_id')));
    if (isset($_POST['save'])) {
        if (empty($_POST['name'])) {
            addMessage('danger', 'Sie müssen einen Namen angeben');
        } elseif (!preg_match("/^[a-zA-Z0-9_.\-@!#$%&;'*+ ]*$/", $_POST['name'])) {
            addMessage('danger', 'Sie haben ein unerlaubtes Zeichen eingegeben. Erlaubte Zeichen:  a-z A-Z 0-9 _.-@!#$%&;\'*+');
        } else {
            db_update_galery($_POST['name'], getSessionValue("user_id"));
            addMessage('success', 'Fotogalerie wurde erfolgreich erstelt');
            redirect('galery', ['galery_id' => $_REQUEST['galery_id']]);
        }
    }
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/galery_update.htm.php");
}

/*
 * Beinhaltet die Anwendungslogik um Bilder einer Galery hinzuzufügen der Upload der
 * Bilder befindet sich im upload.php File
 */
function image_add()
{
    check_galery_access(getRequestParam('galery_id'), getSessionValue('user_id'));
    setValue('galery_id', getRequestParam('galery_id'));
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/image_add.htm.php");
}

/*
 * Beinhaltet die Anwendungslogik Um ein Bild anzuzeigen und ein Tag des Bildes zu löschen
 */
function image_show()
{
    check_galery_access(getRequestParam('galery_id'), getSessionValue('user_id'));
    if (isset($_REQUEST['img_id']) && isset($_REQUEST['galery_id'])) {
        if (isset($_REQUEST['delete_tag']) && isset($_REQUEST['tag_id'])) {
            db_delete_image_tag($_REQUEST['tag_id'], $_REQUEST['img_id'], getSessionValue('user_id'));
            redirect('image_show', ['galery_id' => $_REQUEST['galery_id'], 'img_id' => $_REQUEST['img_id']]);
        } else {
            setValue('tags', db_select_image_tag($_REQUEST['img_id']));
            setValue('image', db_select_image($_REQUEST['img_id'], getSessionValue('user_id')));
            setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
            return runTemplate("../templates/image_show.htm.php");
        }
    } else {
        addMessage('danger', 'Die Seite konnte nicht aufgerufen werden.');
        redirect('galeries');
    }
}

/*
 * Beinhaltet die Anwendungslogik um ein Tag einem Bild hinzuzufügen
 */
function tag_add() {
    if (isset($_POST['save']) && isset($_REQUEST['img_id'])) {
        if (empty($_POST['name'])) {
            addMessage('danger', 'Sie müssen einen Namen angeben');
        } elseif (!preg_match("/^[a-zA-Z0-9_.\-@!#$%&;'*+ ]*$/", $_POST['name'])) {
            addMessage('danger', 'Sie haben ein unerlaubtes Zeichen eingegeben. Erlaubte Zeichen:  a-z A-Z 0-9 _.-@!#$%&;\'*+');
        } else {
            db_insert_tag($_POST["name"], $_REQUEST['img_id'], getSessionValue("user_id"));
            redirect('image_show', ['galery_id' => $_REQUEST['galery_id'], 'img_id' => $_REQUEST['img_id']]);
        }
    }
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/tag_add.htm.php");
}

/*
 * Beinhaltet die Anwendungslogik zn nach Bildern welche Tags haben zu suchen.
 */
function image_search() {
    setValue('tags', db_select_tags());
    if (isset($_REQUEST['search']) && isset($_REQUEST['tags']) && count($_REQUEST['tags']) > 0) {
        setValue('images', db_select_search_image_by_tags($_REQUEST['tags'], getSessionValue('user_id')));
    }
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/image_search.htm.php");
}

/*
 * Beinhaltet die Anwendungslogik um einen User einer Galery hinzuzufügen
 */
function user_galery_create() {
    check_galery_access($_REQUEST['galery_id'], getSessionValue('user_id'));
    if (isset($_POST['save']) && isset($_REQUEST['galery_id'])) {
        if (empty($_POST['email'])) {
            addMessage('danger', 'Sie müssen eine email angeben');
        } elseif (!preg_match("/^[a-zA-Z0-9_.\-@!#$%&;'*+ ]*$/", $_POST['name'])) {
            addMessage('danger', 'Sie haben ein unerlaubtes Zeichen eingegeben. Erlaubte Zeichen:  a-z A-Z 0-9 _.-@!#$%&;\'*+');
        } else {
            db_insert_users_galery_add($_POST["email"], $_REQUEST['galery_id']);
            redirect('galery', ['galery_id' => $_REQUEST['galery_id']]);
        }
    }
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/user_galery_create.htm.php");
}
