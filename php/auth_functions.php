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
            return runTemplate("../templates/registration.htm.php");
        } else {
            db_insert_benutzer($_POST, passwordHash($_POST['password']));
            addMessage('success', 'Valid informations');
        }
    }
}

/*
 * Beinhaltet die Anwendungslogik zum Login
 */
function login()
{
    if (isset($_POST['login'])) {
        $login = true;
    } else {
        $login = false;
    }

    // Das Forum wird ohne Angabe der Funktion aufgerufen bzw. es wurde auf die Schaltfläche "abbrechen" geklickt
    setValue('phpmodule', $_SERVER['PHP_SELF'] . "?id=" . __FUNCTION__);

    addMessage("info", "Test Information");
    if ($login) {
        addMessage("success", "Sie haben sich erfolgreich angemeldet.");
    } else {
        addMessage("danger", "Username oder Passwort sind nicht korrekt.");
    }
    return runTemplate("../templates/login.htm.php");
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