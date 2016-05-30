<h2>Fotoalbum</h2>
<?php

if (getValue('images')) {
    foreach (getValue('images') as $value) {
        echo '<a href="' . $value['foto_path'] . '"><img src="' . $value['image'] . '"></a>';
        ?>
        <form name="show_img" action="index.php?id=show_image&galery_id=<?php echo getValue('galery_id') ?>" method="post">
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
<a href="index.php?id=add_images&galery_id=<?php echo getRequestParam('galery_id') ?>" class="btn btn-primary">Fotos hinzufügen</a>

