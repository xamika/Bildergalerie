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

function db_insert_fotogalerie($name, $user_id) {
    $sql = "insert into tbl_fotogalerien (name)
            values ('".escapeSpecialChars($name)."')";
    sqlQuery($sql);
    $db_return = sqlSelect("SELECT * FROM tbl_fotogalerien ORDER BY id DESC LIMIT 1");
    db_insert_users_fotogalerien($user_id, $db_return[0]['id']);
    return $db_return;
}

function db_insert_users_fotogalerien($user_id, $fotogalerie_id) {
    $sql = "insert into tbl_users_fotogalerien (fk_users, fk_fotogalerie)
            values ('".escapeSpecialChars($user_id)."','".escapeSpecialChars($fotogalerie_id)."')";
    sqlQuery($sql);
}

function db_insert_image($path, $galery_id) {
    $sql = "insert into tbl_fotos (foto_path, fk_fotogalerie)
            values ('".$path."','".$galery_id."')";
    sqlQuery($sql);
}

function db_select_fotogalerien($user_id) {
    $sql = "SELECT * from tbl_users_fotogalerien, tbl_fotogalerien where tbl_users_fotogalerien.fk_fotogalerie = tbl_fotogalerien.id
            and tbl_users_fotogalerien.fk_users = " . $user_id;
    return sqlSelect($sql);
}