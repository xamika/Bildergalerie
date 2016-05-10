<form name="registration" class="form-horizontal" action="<?php echo getValue('phpmodule'); ?>" method="post">

    <div class="form-group">
        <label for="name" class="control-label">Vorname</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Vorname"/>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="control-label">Name</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name"/>
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="control-label">Email</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required/>
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="control-label">Passwort</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
            <input type="password" class="form-control" name="password" id="password"
                   placeholder="Passwort" required/>
        </div>
    </div>

    <div class="form-group">
        <label for="confirm" class="control-label">Confirm Password</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
            <input type="password" class="form-control" name="confirm" id="confirm"
                   placeholder="Confirm your Password" required/>
        </div>
    </div>

    <div class="form-group ">
        <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="registration" value="registration">Registrieren</button>
    </div>
</form>

