<?php
/*
 *  @autor Michael Abplanalp
 *  @version 1.0
 *
 *  Dieses Modul beinhaltet Funktionen, welche die Logik zur Authentifizierung implementieren.
 *
 */

/*
 * Beinhaltet die Anwendungslogik zur Registration
 */
function registration()
{
    if (isset($_POST['registration'])) {
        $error = check_user_data();

        if (!$error) {
            if (isset(db_select_user($_POST['email'])[0])) {
                addMessage('danger', "Email adresse ist bereits vorhanden");
            } else {
                db_insert_benutzer($_POST, passwordHash($_POST['password']));
                addMessage('success', 'Sie haben sich erfolgreich registriert');
                redirect('login');
            }
        }
    }

    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/registration.htm.php");

}

function check_user_data() {
    $error = false;
    foreach ($_POST as $key => $value) {
        if (empty($_POST[$key])) {
            $error = true;
            addMessage('danger', ucwords($key) . " field is required ");
        }
    }
    /* Password Matching Validation */
    if (!CheckPasswordCompare($_POST['password'], $_POST['confirm'])) {
        $error = true;
        addMessage('danger', 'Passwords should be same<br>');
    }

    if (!CheckPasswordFormat($_POST['password'])) {
        $error = true;
        addMessage('danger', 'Passwort entspricht nicht den richtlinien');
    }

    /* Email Validation */
    if (!CheckEmailFormat($_POST["email"])) {
        $error = true;
        addMessage('danger', "Invalid Email ");
    }
    return $error;
}

/*
 * Beinhaltet die Anwendungslogik zum Login
 */
function login()
{
    if (isset($_POST['login'])) {
        $db_result = db_select_user($_POST['email']);
        if (isset($db_result[0]) && passwordVerify($_POST['password'], $db_result[0]['passwort'])) {
            setSessionValue("benutzerId", $db_result[0]['userId']);
            addMessage('success', 'Du hast dich erfolgreich angemeldet');
            redirect('fotoalben');
        } else {
            addMessage('danger', 'Username oder Passwort sind falsch');
        }
    }
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/login.htm.php");
}

function logout()
{
    setSessionValue("benutzerId", null);
    addMessage('success', 'Du hast dich erfolgreich abgemeldet');
    redirect('login');
}

function edit_user() {
    if (isset($_POST['update_user_data'])) {
        $error = check_user_data();
        if (!$error) {
            db_update_benutzer($_POST, passwordHash($_POST['password']), getSessionValue('benutzerId'));
            addMessage('success', 'Daten wurden erfolgreich aktualisiert');
        }
    }
    setValue('user_data', db_select_user_by_id(getSessionValue('benutzerId'))[0]);
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/edit_user.htm.php");
}

/*
 * Prüft, ob ein Benutzer angemeldet ist
 */
function angemeldet()
{
    if (strlen(getSessionValue("benutzerId")) > 0) return true;
    else return false;
}


