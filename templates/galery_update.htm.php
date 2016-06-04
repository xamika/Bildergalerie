<h2>Fotoalbum bearbeiten</h2>



<form name="create_galery" class="form-horizontal" action="<?php echo getValue('phpmodule'); ?>" method="post">

    <div class="form-group">
        <label for="name" class="control-label">Name</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
            <input type="hidden" name="galery_id" value="<?php echo $_REQUEST['galery_id'] ?>">
            <input type="name" class="form-control" name="name" id="name" value="<?php echo getValue('galery')[0]['name'] ?>"
                   required/>
        </div>
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="save" value="save">Speichern</button>
    </div>
</form>
