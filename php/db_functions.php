<?php
/*
 *  @autor Michael Abplanalp
 *  @version 1.0
 *
 *  Dieses Modul beinhaltet sämtliche Datenbankfunktionen.
 *  Die Funktionen formulieren die SQL-Anweisungen und rufen dann die Funktionen
 *  sqlQuery() und sqlSelect() aus dem Modul basic_functions.php auf.
 *
 */

function db_insert_benutzer($params, $passwort) {
    $sql = "insert into tbl_users (vorname, nachname, email, passwort)
            values ('".escapeSpecialChars($params['firstname'])."','".escapeSpecialChars($params['name'])."','".escapeSpecialChars($params['email'])."','".$passwort."')";
    sqlQuery($sql);
}

function db_select_user($email) {
    $sql = "select * from tbl_users where email ='" . escapeSpecialChars($email) . "'";
    return sqlSelect($sql);
}
