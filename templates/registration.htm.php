<form name="registration" class="form-horizontal" action="<?php echo getValue('phpmodule'); ?>" method="post">

    <div class="form-group">
        <label for="name" class="cols-sm-2 control-label">Your Name</label>
        <div class="cols-sm-10">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter your Name"/>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="email" class="cols-sm-2 control-label">Your Email</label>
        <div class="cols-sm-10">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email" required/>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="cols-sm-2 control-label">Password</label>
        <div class="cols-sm-10">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                <input type="password" class="form-control" name="password" id="password"
                       placeholder="Enter your Password" required/>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
        <div class="cols-sm-10">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                <input type="password" class="form-control" name="confirm" id="confirm"
                       placeholder="Confirm your Password" required/>
            </div>
        </div>
    </div>

    <div class="form-group ">
        <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Registrieren</button>
    </div>
</form>

