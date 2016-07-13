<?php

function request_password_reset_form()
{
    ob_start(); ?>
    <div class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
        <div class="panel panel-primary">
             <div class="panel-heading">Reset Password</div>
             <div class="panel-body additional-fields-panel">

                <?php if( errorsHas("login-error") ): ?>
                    <div class="alert alert-success">
                        <?php echo $_SESSION["errors"]["pass-error"] ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo get_admin_url() ?>admin-post.php" class="form-horizontal" method="post">
                    <input type="hidden" name="user_noncename" id="user_noncename" value="<?php echo wp_create_nonce( get_template_directory_uri( __FILE__ ) ) ?>" />
                    <input type='hidden' name='action' value='submit-request-password-reset-form' />

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Email:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="user_login" value="<?php old("email") ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <?php
        unset($_SESSION['success']);
        unset($_SESSION['errors']['password-reset']);
    ?>
    <?php
    return ob_get_clean();
}


?>
