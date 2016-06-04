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
                db_insert_user($_POST, passwordHash($_POST['password']));
                addMessage('success', 'Sie haben sich erfolgreich registriert');
                redirect('login');
            }
        }
    }

    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/user_registration.htm.php");

}

/*
 * Beinhaltet die Anwendungslogik zum Login
 */
function login()
{
    if (isset($_POST['login'])) {
        $db_result = db_select_user($_POST['email']);
        if (isset($db_result[0]) && passwordVerify($_POST['password'], $db_result[0]['password'])) {
            setSessionValue("user_id", $db_result[0]['id']);
            addMessage('success', 'Du hast dich erfolgreich angemeldet');
            redirect('fotoalben');
        } else {
            addMessage('danger', 'Username oder Passwort sind falsch');
        }
    }
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/user_login.htm.php");
}

/*
 * Beinhaltet die Anwendungslogik um sich auszuloggen.
 */
function logout()
{
    setSessionValue("user_id", null);
    addMessage('success', 'Du hast dich erfolgreich abgemeldet');
    redirect('login');
}

/*
 * Beinhaltet die Anwendungslogik um die Benutzerdaten zu bearbeiten.
 */
function user_edit()
{
    if (isset($_POST['update_user_data'])) {
        $error = check_user_data();
        if (!$error) {
            db_update_user($_POST, passwordHash($_POST['password']), getSessionValue('user_id'));
            addMessage('success', 'Daten wurden erfolgreich aktualisiert');
        }
    } elseif (isset($_POST['delete'])) {
        db_delete_user(getSessionValue('user_id'));
        addMessage('success', 'Ihr Konto wurde erfolgreich gelöst.');
        redirect('logout');
    }
    setValue('user_data', db_select_user_by_id(getSessionValue('user_id'))[0]);
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
    return runTemplate("../templates/user_edit.htm.php");
}

/*
 * Prüft, ob ein Benutzer angemeldet ist
 */
function angemeldet()
{
    if (strlen(getSessionValue("user_id")) > 0) return true;
    else return false;
}


/*
* Prüft, ob ie Benutzerdaten valid sind
*/
function check_user_data()
{
    $error = false;
    foreach ($_POST as $key => $value) {
        if (empty($_POST[$key])) {
            $error = true;
            addMessage('danger', ucwords($key) . " ist ein Pflichtfeld.");
        } elseif ($key != "password" && $key != "confirm" && !preg_match("/^[a-zA-Z0-9_.\-@!#$%&;'*+ ]*$/", $_POST[$key]))
        {
            $error = true;
            addMessage('danger', "Sie haben ein unerlaubtes Zeichen im Feld " . ucwords($key) . " verwendet. Bitte verwende eines der folgenden Zeichen: a-z A-Z 0-9 _.-@!#$%&;'*+");
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



