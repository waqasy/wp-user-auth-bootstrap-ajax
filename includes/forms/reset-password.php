<?php
function uab_password_reset_form()
{
    ?>

    <?php
        //If user randomly accesses this link he would be redirected.
        if( !($_REQUEST['action'] === "rp") )
        {
            return wp_redirect( '/coverager' );
        }
    ?>

    <div class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
        <div class="panel panel-primary">
            <div class="panel-heading">Reset Password</div>
            <div class="panel-body">

                <div class="alert alert-danger reset-password-error hidden">
                </div>

                <div class="alert alert-success reset-password-success hidden">
                </div>

                <form action="http://localhost:8888/coverager/wp-json/reset-password/v1/user" class="form-horizontal" method="post">
                    <input type="hidden" name="login" id="login" value="<?php echo $_REQUEST['login'] ?>">
                    <input type="hidden" name="key" id="key" value="<?php echo $_REQUEST['key'] ?>">

                    <div class="form-group email-reset-password">
                        <label for="email" class="col-md-4 control-label">Email:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="email" id="email-reset-password">

                            <span class="help-block email-reset-password-error hidden">
                                <strong class="email-reset-password-error-text"></strong>
                            </span>

                        </div>
                    </div>

                    <div class="form-group password-reset-password">
                        <label for="password" class="col-md-4 control-label">Password:</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password-reset-password" name="password">

                            <span class="help-block password-reset-password-error hidden">
                                <strong class="password-reset-password-error-text"></strong>
                            </span>

                        </div>
                    </div>

                    <div class="form-group password_confirm-reset-password">
                        <label for="password_confirm" class="col-md-4 control-label">Confirm Password:</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password_confirm-reset-password" name="password_confirm">

                            <span class="help-block password_confirm-reset-password-error hidden">
                                <strong class="password_confirm-reset-password-error-text"></strong>
                            </span>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4 reset-password">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-refresh"></i> Reset Password
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php
    //returns current buffer contents and delete current output buffer

}

?>
