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


/**
 * Fügt einen Neuen User in die DB ein
 *
 * @param $params       Array mit fistname lastname email
 * @param $password     verschlüsseltes Passwort
 */
function db_insert_user($params, $password)
{
    $sql = "insert into user (firstname, lastname, email, password)
            values ('" . escapeSpecialChars($params['firstname']) . "','" . escapeSpecialChars($params['name']) . "','" . escapeSpecialChars($params['email']) . "','" . $password . "')";
    sqlQuery($sql);
}

/**
 * Aktualisiert die User daten
 *
 * @param $params       Array mit fistname lastname email
 * @param $password     verschlüsseltes Passwort
 * @param $user_id      user id in der DB
 */
function db_update_user($params, $password, $user_id)
{
    $sql = "update user set firstname='" . escapeSpecialChars($params['firstname']) . "',
        lastname='" . escapeSpecialChars($params['name']) . "',
        email='" . escapeSpecialChars($params['email']) . "', password='" . $password . "'
            where id =" . $user_id;
    sqlQuery($sql);
}

/**
 * Löscht einen User und alle von ihm abhängige Tabellen
 *
 * @param $user_id  ID des zu löschenden Users
 */
function db_delete_user($user_id)
{
    $galeries = db_select_galeries($user_id);
    if (isset($galeries[0])) {
        foreach ($galeries as $galery_value) {
            db_delete_galery($galery_value['id'], $user_id);
        }
    }
    sqlQuery("DELETE FROM user WHERE id = " . $user_id);
}

/**
 * Abfrage eines Users anhand seiner ID
 *
 * @param $id               ID des userses
 * @return array|string     Array mit allen user Daten
 */
function db_select_user_by_id($id)
{
    $sql = "select * from user where id =" . $id;
    return sqlSelect($sql);
}

/**
 * Abfrage eines Users anhand seiner Email
 *
 * @param $email            Email des Users
 * @return array|string     Array mit allen user Daten
 */
function db_select_user($email)
{
    $sql = "select * from user where email ='" . escapeSpecialChars($email) . "'";
    return sqlSelect($sql);
}

/**
 * Fügt eine neue Galery hinzu
 *
 * @param $name             Name der Galery
 * @param $user_id          User ID
 * @return array|string     Array mit den Daten der erstellten Galery
 */
function db_insert_galery($name, $user_id)
{
    $sql = "insert into galery (name)
            values ('" . escapeSpecialChars($name) . "')";
    sqlQuery($sql);
    $db_return = sqlSelect("SELECT * FROM galery ORDER BY id DESC LIMIT 1");
    db_insert_users_galery($user_id, $db_return[0]['id']);
    return $db_return;
}

/**
 * Ändert den Namen einer Galery
 *
 * @param $name
 */
function db_update_galery($name)
{
    $sql = "update galery set name='" . escapeSpecialChars($name) . "'";
    sqlQuery($sql);
}

/**
 * Fügt einem User eine neue Galery hinzu
 *
 * @param $user_id
 * @param $fotogalerie_id
 */
function db_insert_users_galery($user_id, $fotogalerie_id)
{
    $sql = "insert into user_galery (user_id, galery_id)
            values ('" . escapeSpecialChars($user_id) . "','" . escapeSpecialChars($fotogalerie_id) . "')";
    sqlQuery($sql);
}

/**
 * Fügt einem User falls dieser vorhanden ist eine Galery hinzu
 *
 * @param $email            Email des Users
 * @param $fotogalerie_id
 */
function db_insert_users_galery_add($email, $fotogalerie_id)
{
    $user_data = db_select_user($email);
    if ($user_data) {
        $user_galery_data = db_select_users_galery($fotogalerie_id, $user_data[0]['id']);
        if (!$user_galery_data) {
            $sql = "insert into user_galery (user_id, galery_id)
            values ('" . escapeSpecialChars($user_data[0]['id']) . "','" . escapeSpecialChars($fotogalerie_id) . "')";
            sqlQuery($sql);
            addMessage('success', 'User wurde erfolgreich berechtigt.');
        } else {
            addMessage('danger', 'User mit der Email ' . $email . ' ist bereits berechtigt.');
        }
    } else {
        addMessage('danger', 'User mit der Email ' . $email . ' existiert nicht.');
    }
}

/**
 * Fügt ein neues Bild in die Datenbank ein
 *
 * @param $path         Pfad zum Bilder in orginalgrüsse
 * @param $galery_id
 * @param $thumb_path   Pfad zum thubnail
 */
function db_insert_image($path, $galery_id, $thumb_path)
{
    $sql = "insert into image (image_path, galery_id, image_thumb_path)
            values ('" . $path . "','" . $galery_id . "', '" . $thumb_path . "')";
    sqlQuery($sql);
}

/**
 * Gibt alle Galerien eines Users zurück
 *
 * @param $user_id
 * @return array|string
 */
function db_select_galeries($user_id)
{
    $sql = "SELECT * from galery, user_galery where user_galery.galery_id = galery.id
            and user_galery.user_id = " . $user_id;
    return sqlSelect($sql);
}

/**
 * Gibt die Datein einer Galery zurück
 *
 * @param $galery_id
 * @param $user_id
 * @return array|string
 */
function db_select_galery($galery_id, $user_id)
{
    $sql = "SELECT * from galery, user_galery where user_galery.galery_id = " . escapeSpecialChars($galery_id) . "
            and user_galery.user_id = " . $user_id;
    return sqlSelect($sql);
}

/**
 * Abfrage aller Bilder welche in einer Galery sind
 *
 * @param $id               ID der Galery
 * @param $user_id
 * @return array|string     array mit allen Bilder Daten
 */
function db_select_galery_images($id, $user_id)
{
    $sql = "SELECT * from user_galery, galery, image where user_galery.galery_id = galery.id
            and user_galery.user_id = " . $user_id . " AND image.galery_id = " . $id . " and galery.id = " . $id . " group by image.id";
    return sqlSelect($sql);
}

/**
 * Löscht eine Galery
 *
 * @param $galery_id
 * @param $user_id
 */
function db_delete_galery($galery_id, $user_id)
{
    $sql_images = "SELECT * from user_galery, galery, image where user_galery.galery_id = galery.id
            and user_galery.user_id = " . $user_id . " and galery.id = " . $galery_id . " group by image.id";

    $sql_galery = "SELECT * from user_galery, galery where user_galery.galery_id = galery.id
            and user_galery.user_id = " . $user_id . " and galery.id = " . $galery_id;
    $images = sqlSelect($sql_images);
    $galery = sqlSelect($sql_galery);
    if (isset($images[0])) {
        foreach ($images as $image) {
            unlink($image['image_path']);
            unlink($image['image']);
            sqlQuery("DELETE FROM image WHERE id =" . $image['id']);
            sqlQuery("DELETE FROM image_tag WHERE image_id =" . $image['id']);
        }
        sqlQuery("DELETE FROM galery WHERE id =" . $galery_id);
        sqlQuery("DELETE FROM user_galery WHERE galery_id =" . $galery_id);
        addMessage('success', 'Die Fotogalerie ' . $images[0]['name'] . ' wurde erfolgreich gelöst');
    } elseif (isset($galery[0])) {
        sqlQuery("DELETE FROM galery WHERE id =" . $galery_id);
        sqlQuery("DELETE FROM user_galery WHERE galery_id =" . $galery_id);
        addMessage('success', 'Die Fotogalerie ' . $images[0]['name'] . ' wurde erfolgreich gelöst');
    } else {
        addMessage('danger', "Du darfst diese Bildergallerie nicht löschen oder sie wurde bereits gelöst.");
    }
}

/**
 * Abfrage eines Bildes
 *
 * @param $img_id
 * @param $user_id
 * @return array|string Array mit den Bild Daten
 */
function db_select_image($img_id, $user_id)
{
    $sql = "SELECT * from user_galery, galery, image where user_galery.galery_id = galery.id
            and user_galery.user_id = " . $user_id . " and image.id = " . $img_id . " group by image.id";
    return sqlSelect($sql);
}

/**
 * Löscht ein Bild aus einer Galery
 *
 * @param $img_id
 * @param $user_id
 */
function db_delete_image($img_id, $user_id)
{
    $img_data = db_select_image($img_id, $user_id);
    if (isset($img_data[0])) {
        unlink($img_data[0]['image_path']);
        unlink($img_data[0]['image_thumb_path']);
        sqlQuery("DELETE FROM image WHERE id =" . $img_id);
        sqlQuery("DELETE FROM image_tag WHERE image_id =" . $img_id);
        addMessage('success', 'Das Bild wurde erfolgreich gelöst');
    } else {
        addMessage('danger', "Sie dürfen dieses Bild nicht löschen oder es wurde bereits gelöst.");
    }
}

/**
 * Abfrage der user_galery tabelle
 *
 * @param $galery_id
 * @param $user_id
 * @return array|string
 */
function db_select_users_galery($galery_id, $user_id)
{
    return sqlSelect("SELECT * FROM user_galery WHERE user_id = " . $user_id . " and galery_id = " . escapeSpecialChars($galery_id));
}

/**
 * Hinzufügen eines neuen Tags zu einem Bild
 *
 * @param $tag_name
 * @param $img_id
 * @param $user_id
 */
function db_insert_tag($tag_name, $img_id, $user_id)
{
    $img_data = db_select_image($img_id, $user_id);
    if (isset($img_data[0])) {
        $tag_data = db_select_tag($tag_name);
        if (isset($tag_data[0]['id'])) {
            sqlQuery("INSERT INTO image_tag (image_id, tag_id) VALUES ('" . escapeSpecialChars($img_id) . "', " . $tag_data[0]['id'] . ")");
        } else {
            sqlQuery("INSERT INTO tag (name) VALUES ('" . escapeSpecialChars($tag_name) . "')");
            $tag_data = db_select_tag($tag_name);
            sqlQuery("INSERT INTO image_tag (image_id, tag_id) VALUES ('" . escapeSpecialChars($img_id) . "', " . $tag_data[0]['id'] . ")");
        }
        addMessage('success', 'Tag wurde erfolgreich hinzugefügt');
    } else {
        addMessage('danger', "Sie dürfen diesem Bild keine Tags hinzufügen");
    }
}

/**
 * Abfrage eines Tags
 *
 * @param $tag_name     Name des gesuchten Tags
 * @return array|string Array mit den Tag Daten
 */
function db_select_tag($tag_name)
{
    $sql = "SELECT * FROM tag WHERE tag.name = '" . escapeSpecialChars($tag_name) . "'";
    return sqlSelect($sql);
}

/**
 * Abfrage aller Tags eines Bildes.
 *
 * @param $img_id
 * @return array|string
 */
function db_select_image_tag($img_id)
{
    $sql = "SELECT * FROM tag, image_tag WHERE image_tag.image_id = " . escapeSpecialChars($img_id) . " AND tag.id = image_tag.tag_id";
    return sqlSelect($sql);
}

/**
 * Löschen eines Tags welches einem Bild zugewiesen ist
 *
 * @param $image_tag_id
 * @param $img_id
 * @param $user_id
 */
function db_delete_image_tag($image_tag_id, $img_id, $user_id)
{
    $img_data = db_select_image($img_id, $user_id);
    if (isset($img_data[0])) {
        sqlQuery("DELETE FROM image_tag WHERE id = " . escapeSpecialChars($image_tag_id));
        addMessage('success', 'Tag wurde erfolgreich gelöst');
    } else {
        addMessage('danger', "Sie dürfen diesen Tag nicht löschen.");
    }
}

/**
 * Sucht nach Bildern welche bestimmte Tags haben
 *
 * @param $tags         Array mit allen Tags nach denen gesucht werden soll
 * @param $user_id
 * @return array|string Rückgabe der Bild Daten
 */
function db_select_search_image_by_tags($tags, $user_id)
{
    $where_tags = "";
    $first_time = true;
    foreach ($tags as $tag_id) {
        if ($first_time) {
            $where_tags = ' (tag.id = ' . escapeSpecialChars($tag_id);
            $first_time = false;
        } else {
            $where_tags = $where_tags . ' OR tag.id = ' . escapeSpecialChars($tag_id);
        }
    }
    $where_tags = $where_tags . ")";
    $sql = 'SELECT tag.name AS "tag_name", galery.id AS "galery_id", galery.name AS "galery_name", image.image_path, image.image_thumb_path, image.id AS "image_id" FROM user_galery, galery, image, image_tag, tag WHERE
        user_galery.galery_id = galery.id AND
        galery.id = image.galery_id AND
        image_tag.image_id = image.id AND
        image_tag.tag_id = tag.id AND
        user_galery.user_id = ' . escapeSpecialChars($user_id) . ' AND ' . $where_tags . ' GROUP BY image.id';
    return sqlSelect($sql);
}

/**
 * Gibt alle Tags welche in der Datenbank sind zurück
 *
 * @return array|string
 */
function db_select_tags()
{
    return sqlSelect("SELECT * FROM tag");
}