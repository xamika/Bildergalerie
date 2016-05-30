<h2>Fotoalben</h2>
<?php

if (getValue('galery')) {
    foreach (getValue('galery') as $galery) {
        echo "<a href='index.php?id=galery&galery_id=" . $galery['id'] . "'>" . $galery['name'] . "</a><br>";
        ?>
        <form method="POST" onsubmit="return confirm('Sind Sie sicher?');">
            <input type="hidden" name="galery_id" value="<?php echo $galery['id']; ?>">
            <button class="btn btn-danger" name="delete" type="submit">Löchen</button>
        </form>
        <?php
    }
} else {
    echo "<h4>Sie haben noch kein Fotoalbum erstellt.</h4>";
}

