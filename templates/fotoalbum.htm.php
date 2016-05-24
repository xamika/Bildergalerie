<h2>Fotoalbum</h2>
<?php

if (getValue('images')) {
    foreach (getValue('images') as $value) {
        echo '<img src="'.$value['foto_path'].'" alt="Mountain View">';
    }
} else {
    echo "<h4>Es wurden keine Fotos gefunden.</h4>";
}

