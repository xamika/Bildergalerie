<h2>Tag hinzufügen</h2>



<form name="tag_add" class="form-horizontal" action="<?php echo getValue('phpmodule') .  "&" . "galery_id=" . $_REQUEST['galery_id'] . "&img_id=". $_REQUEST['img_id']; ?>" method="post">

    <div class="form-group">
        <label for="name" class="control-label">Name</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-tags" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                   required/>
        </div>
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="save" value="save">Speichern</button>
    </div>
</form>
