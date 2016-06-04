<h2>User berechtigen</h2>



<form name="tag_add" class="form-horizontal" action="<?php echo getValue('phpmodule') .  "&" . "galery_id=" . $_REQUEST['galery_id']; ?>" method="post">

    <div class="form-group">
        <label for="name" class="control-label">Email</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-tags" aria-hidden="true"></i></span>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                   required/>
        </div>
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="save" value="save">Speichern</button>
    </div>
</form>
