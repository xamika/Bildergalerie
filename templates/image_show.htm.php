<h2>Bild anzeigen</h2>
<?php

if (getValue('image')) {
    foreach (getValue('image') as $value) {
        echo '<a href="index.php?id=galery&galery_id=' . $_REQUEST['galery_id'] . '&img_id=' . $value['id'] . '&delete" class="btn btn-danger">Löschen</a><br>';
        echo '<img style="max-width: 700px;" src="' . $value['image_path'] . '">';
        ?>

        <?php
    }
} else {
    echo "<h4>Es wurden keine Fotos gefunden.</h4>";
}