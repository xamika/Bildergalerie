<h2>Fotoalbum</h2>
<?php

if (getValue('images')) {
    foreach (getValue('images') as $value) {
        echo '<a href="' . $value['foto_path'] . '"><img src="' . $value['image'] . '" alt="Mountain View"></a>';
        ?>
        <form name="show_img" action="index.php?id=show_image&nr=<?php echo getValue('galery_id') ?>" method="post">
            <button type="submit" class="btn btn-primary btn-sm" name="img_id" value="<?php echo $value['id'] ?>">
                Show
            </button>
        </form>
        <?php
    }
} else {
    echo "<h4>Es wurden keine Fotos gefunden.</h4>";
}
?>
<a href="index.php?id=add_images" class="btn btn-primary">Fotos hinzufügen</a>

