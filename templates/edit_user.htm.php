<form name="edit_user" class="form-horizontal" action="<?php echo getValue('phpmodule'); ?>" method="post">

    <div class="form-group">
        <label for="name" class="control-label">Vorname</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Vorname"
                   value="<?php if (isset(getValue('user_data')['vorname'])) echo getValue('user_data')['vorname']; ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label for="name" class="control-label">Name</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                   value="<?php if (isset(getValue('user_data')['nachname'])) echo getValue('user_data')['nachname']; ?>"/>
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="control-label">Email</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                   value="<?php if (isset(getValue('user_data')['email'])) echo getValue('user_data')['email']; ?>"
                   required/>
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="control-label">Neues Passwort</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
            <input type="password" class="form-control" name="password" id="password"
                   placeholder="Passwort" required/>
        </div>
    </div>

    <div class="form-group">
        <label for="confirm" class="control-label">Neues Passwort wiederholen</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
            <input type="password" class="form-control" name="confirm" id="confirm"
                   placeholder="Passwort wiederholen" required/>
        </div>
    </div>

    <div class="form-group ">
        <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="update_user_data"
                value="update">Speichern
        </button>
    </div>
</form>
<form method="POST" onsubmit="return confirm('Sind Sie sicher? Alle Ihre Daten gehen verlohren.');">
    <button class="btn btn-danger" name="delete" type="submit">Löchen</button>
</form>

