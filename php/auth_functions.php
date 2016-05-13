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
    // Template abfüllen und Resultat zurückgeben
    /*
    Form Required Field Validation */
    $message = "";
    $error = false;
    if (isset($_POST['registration'])) {
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

        /* Email Validation */
        if (!CheckEmailFormat($_POST["email"])) {
            $error = true;
            addMessage('danger', "Invalid UserEmail ");
        }
        if ($error) {
            setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
            return runTemplate("templates/registration.htm.php");
        } else {
            db_insert_benutzer($_POST, passwordHash($_POST['password']));
            addMessage('success', 'Sie haben sich erfolgreich registriert');
            setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=login");
            return runTemplate("templates/login.htm.php");
        }
    } else {
        setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
        return runTemplate("templates/registration.htm.php");
    }
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
            header("Location: index.php?id=fotoalben");
            exit();
        } else {
            setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
            addMessage('success', 'Du hast dich erfolgreich angemeldet');
            return runTemplate("templates/login.htm.php");
        }
    } else {
        setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);
        return runTemplate("templates/login.htm.php");
    }
}

function logout()
{
    setSessionValue("benutzerId", null);
    addMessage('success', 'Du hast dich erfolgreich abgemeldet');
    header("Location: index.php");
    exit();
}

/*
 * Prüft, ob ein Benutzer angemeldet ist
 */
function angemeldet()
{
    if (strlen(getSessionValue("benutzerId")) > 0) return true;
    else return false;
}

?>