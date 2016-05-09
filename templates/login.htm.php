<form name="login" class="form-horizontal" action="<?php echo getValue('phpmodule'); ?>" method="post">

    <div class="form-group">
        <label for="email" class="control-label">Your Email</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email"
                   required/>
        </div>
    </div>


    <div class="form-group">
        <label for="password" class="control-label">Password</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
            <input type="password" class="form-control" name="password" id="password"
                   placeholder="Enter your Password" required/>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block login-button" name="login" value="login">Login</button>
    </div>
</form>
