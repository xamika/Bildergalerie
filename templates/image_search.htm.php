<link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css" type="text/css"/>
<script src="../bower_components/select2/dist/js/select2.min.js"></script>
<h2>Bild Suchen</h2>

<form name="image_search" class="form-horizontal" action="<?php echo getValue('phpmodule') ?>" method="post">

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
            <select multiple="true" name="tags[]" id="tags" class="form-control tags">
                <?php
                foreach (getValue('tags') as $tag) {
                    echo '<option value="' . $tag['id'] . '">' . $tag['name'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="search" value="search">
            Suchen
        </button>
    </div>
</form>

<?php

if (getValue('images')) {
    foreach (getValue('images') as $image) {
        echo '<a href="' . $image['image_path'] . '"><img src="' . $image['image_thumb_path'] . '"></a>';
        ?>
        <form name="show_img" action="index.php?id=image_show&galery_id=<?php echo $image['galery_id'] ?>"
              method="post">
            <button type="submit" class="btn btn-primary btn-sm" name="img_id" value="<?php echo $image['image_id'] ?>">
                Anzeigen/Bearbeiten
            </button>
        </form>
        <?php
    }
} else {
    echo "<h4>Es wurden keine Fotos gefunden.</h4>";
}
?>
<script>
    $(".tags").select2({})
</script>

