<h2>Bild anzeigen</h2>
<?php
if (getValue('image')) {
    foreach (getValue('image') as $value) {
        if (getValue('tags')) {
            foreach (getValue('tags') as $tag) {
                echo $tag['name'] . '<a href="index.php?id=image_show&galery_id=' . $_REQUEST['galery_id'] .
                    '&img_id=' . $value['id'] . '&tag_id=' . $tag['id'] .
                    '&delete_tag" class="btn btn-danger btn-xs">Löschen</a>';
            }
            echo "<br>";
        }
        echo '<img style="max-width: 700px;" src="' . $value['image_path'] . '"><br>';
        echo '<a href="index.php?id=galery&galery_id=' . $_REQUEST['galery_id'] . '&img_id=' . $value['id'] . '&delete" class="btn btn-danger">Bild Löschen</a><br>';
        echo '<a href="index.php?id=tag_add&galery_id=' . $_REQUEST['galery_id'] . '&img_id=' . $value['id'] . '" class="btn btn-primary">Tag hinzufügen</a><br>';

        ?>

        <?php
    }
} else {
    echo "<h4>Es wurden keine Fotos gefunden.</h4>";
}