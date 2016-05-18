<h2>Fotoalbum erstellen</h2>



<form name="create_fotoalbum" class="form-horizontal" action="<?php echo getValue('phpmodule'); ?>" method="post">

    <div class="form-group">
        <label for="name" class="control-label">Name</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
            <input type="name" class="form-control" name="name" id="name" placeholder="Name"
                   required/>
        </div>
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="save" value="save">Speichern</button>
    </div>
</form>
