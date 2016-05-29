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

function db_insert_benutzer($params, $passwort)
{
    $sql = "insert into tbl_users (vorname, nachname, email, passwort)
            values ('" . escapeSpecialChars($params['firstname']) . "','" . escapeSpecialChars($params['name']) . "','" . escapeSpecialChars($params['email']) . "','" . $passwort . "')";
    sqlQuery($sql);
}

function db_update_benutzer($params, $passwort, $user_id)
{
    $sql = "update tbl_users set vorname='" . escapeSpecialChars($params['firstname']) . "',
        nachname='" . escapeSpecialChars($params['name']) . "',
        email='" . escapeSpecialChars($params['email']) . "', passwort='" . $passwort . "'
            where userId =" . $user_id;
    sqlQuery($sql);
}

function db_delete_user($id) {

}

function db_select_user_by_id($id)
{
    $sql = "select * from tbl_users where userId =" . $id;
    return sqlSelect($sql);
}

function db_select_user($email)
{
    $sql = "select * from tbl_users where email ='" . escapeSpecialChars($email) . "'";
    return sqlSelect($sql);
}

function db_insert_fotogalerie($name, $user_id)
{
    $sql = "insert into tbl_fotogalerien (name)
            values ('" . escapeSpecialChars($name) . "')";
    sqlQuery($sql);
    $db_return = sqlSelect("SELECT * FROM tbl_fotogalerien ORDER BY id DESC LIMIT 1");
    db_insert_users_fotogalerien($user_id, $db_return[0]['id']);
    return $db_return;
}

function db_insert_users_fotogalerien($user_id, $fotogalerie_id)
{
    $sql = "insert into tbl_users_fotogalerien (fk_users, fk_fotogalerie)
            values ('" . escapeSpecialChars($user_id) . "','" . escapeSpecialChars($fotogalerie_id) . "')";
    sqlQuery($sql);
}

function db_insert_image($path, $galery_id, $thumb_path)
{
    $sql = "insert into tbl_fotos (foto_path, fk_fotogalerie, image)
            values ('" . $path . "','" . $galery_id . "', '" . $thumb_path . "')";
    sqlQuery($sql);
}

function db_select_fotogalerien($user_id)
{
    $sql = "SELECT * from tbl_users_fotogalerien, tbl_fotogalerien where tbl_users_fotogalerien.fk_fotogalerie = tbl_fotogalerien.id
            and tbl_users_fotogalerien.fk_users = " . $user_id;
    return sqlSelect($sql);
}

function db_select_fotogalerie_images($id, $user_id)
{
    $sql = "SELECT * from tbl_users_fotogalerien, tbl_fotogalerien, tbl_fotos where tbl_users_fotogalerien.fk_fotogalerie = tbl_fotogalerien.id
            and tbl_users_fotogalerien.fk_users = " . $user_id . " AND tbl_fotos.fk_fotogalerie = " . $id . " group by tbl_fotos.id";
    return sqlSelect($sql);
}

function db_delete_fotogalerie($id, $user_id)
{

}

function db_select_image($img_id, $user_id)
{
    $sql = "SELECT * from tbl_users_fotogalerien, tbl_fotogalerien, tbl_fotos where tbl_users_fotogalerien.fk_fotogalerie = tbl_fotogalerien.id
            and tbl_users_fotogalerien.fk_users = " . $user_id . " and tbl_fotos.id = " . $img_id . " group by tbl_fotos.id";
    return sqlSelect($sql);
}

function db_delete_image($img_id, $user_id) {
    $sql = "SELECT * from tbl_users_fotogalerien, tbl_fotogalerien, tbl_fotos where tbl_users_fotogalerien.fk_fotogalerie = tbl_fotogalerien.id
            and tbl_users_fotogalerien.fk_users = " . $user_id . " and tbl_fotos.id = " . $img_id . " group by tbl_fotos.id";
    $img_data = sqlSelect($sql);
    if (isset($img_data[0])) {
        unlink($img_data[0]['foto_path']);
        unlink($img_data[0]['image']);
        $sql = "Delete FROM tbl_fotos where id =" . $img_id;
        sqlQuery($sql);
        addMessage('success', 'Das Bild wurde erfolgreich gelöst');
    } else {
        addMessage('danger', "Du darfst dieses Bild nicht löschen oder es wurde bereits gelöst.");
    }
}