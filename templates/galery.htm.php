<h2>Fotoalbum</h2>
<?php

if (getValue('images')) {
    foreach (getValue('images') as $value) {
        echo '<a href="' . $value['image_path'] . '"><img src="' . $value['image_thumb_path'] . '"></a>';
        ?>
        <form name="show_img" action="index.php?id=image_show&galery_id=<?php echo getValue('galery_id') ?>" method="post">
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
<a href="index.php?id=image_add&galery_id=<?php echo getRequestParam('galery_id') ?>" class="btn btn-primary">Fotos hinzufügen</a>

