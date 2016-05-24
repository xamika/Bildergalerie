<h2>Fotoalben</h2>
<?php

if (getValue('fotoalbum')) {
    foreach (getValue('fotoalbum') as $fotoalbum) {
        echo "<a href='index.php?id=fotoalbum&nr=" . $fotoalbum['id'] . "'>" . $fotoalbum['name'] . "</a><br>";
    }
} else {
    echo "<h4>Sie haben noch kein Fotoalbum erstellt.</h4>";
}

