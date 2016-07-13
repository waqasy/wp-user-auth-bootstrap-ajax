<?php

function login_form()
{
    ob_start(); ?>

    <?php session_start(); ?>
    <div class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
        <div class="panel panel-primary">
             <div class="panel-heading">Login</div>
             <div class="panel-body additional-fields-panel">

                <?php if( errors_has("login_error") ): ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION["errors"]["login_error"] ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo get_admin_url() ?>admin-post.php" class="form-horizontal" method="post">
                    <input type="hidden" name="user_noncename" id="user_noncename" value="<?php echo wp_create_nonce( get_template_directory_uri( __FILE__ ) ) ?>" />
                    <input type='hidden' name='action' value='submit-login-form' />

                    <div class="form-group">
                        <label for="username" class="col-md-4 control-label">Username:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="username" value="<?php old("username") ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Password:</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" value="true"> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-sign-in"></i> Login
                            </button>
                            <a class="btn btn-link" href="/coverager/lostpassword">Forgot Your Password?</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <?php
        unset($_SESSION['errors']);
    ?>

    <?php
    return ob_get_clean();
}

 ?>
