<h2>Fotoalben</h2>
<?php
foreach (getValue('fotoalbum') as $value) {
    echo $value['name'] . " " . $value['id'] . "<br>";
}