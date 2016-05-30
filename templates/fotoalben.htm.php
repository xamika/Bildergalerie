<h2>Fotoalben</h2>
<?php

if (getValue('fotoalbum')) {
    foreach (getValue('fotoalbum') as $fotoalbum) {
        echo "<a href='index.php?id=fotoalbum&galery_id=" . $fotoalbum['id'] . "'>" . $fotoalbum['name'] . "</a><br>";
        ?>
        <form method="POST" onsubmit="return confirm('Sind Sie sicher?');">
            <input type="hidden" name="galery_id" value="<?php echo $fotoalbum['id']; ?>">
            <button class="btn btn-danger" name="delete" type="submit">Löchen</button>
        </form>
        <?php
    }
} else {
    echo "<h4>Sie haben noch kein Fotoalbum erstellt.</h4>";
}

