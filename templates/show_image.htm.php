<h2>Show Image</h2>
<?php

if (getValue('image')) {
    foreach (getValue('image') as $value) {
        echo '<a href="index.php?id=fotoalbum&nr=' . $_REQUEST['nr'] . '&img_id=' . $value['id'] . '&delete" class="btn btn-danger">Löschen</a><br>';
        echo '<img style="max-width: 700px;" src="' . $value['foto_path'] . '">';
        ?>

        <?php
    }
} else {
    echo "<h4>Es wurden keine Fotos gefunden.</h4>";
}