<?php
function password_reset_form()
{
    ob_start(); ?>


    <?php session_start(); ?>

    <div class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
        <div class="panel panel-primary">
            <div class="panel-heading">Reset Password</div>
            <div class="panel-body additional-fields-panel">

                <?php check_reset_link($_REQUEST['key'], $_REQUEST['login']); ?>

                <form action="<?php echo get_admin_url() ?>admin-post.php" class="form-horizontal" method="post">
                    <input type="hidden" name="user_noncename" id="user_noncename" value="<?php echo wp_create_nonce( get_template_directory_uri( __FILE__ ) ) ?>" />
                    <input type='hidden' name='action' value='submit-password-reset-form' />

                    <div class="<?php echo "form-group" . ( errorsHas("email") ? " has-error" : "" );  ?>">
                        <label for="email" class="col-md-4 control-label">Email:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="email" value="<?php old("email") ?>">

                            <?php if( errorsHas("email") ): ?>
                                <span class="help-block">
                                    <strong><?php echo $_SESSION["errors"]["email"]; ?></strong>
                                </span>
                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="<?php echo "form-group" . ( errorsHas("password") ? " has-error" : "" );  ?>">
                        <label for="password" class="col-md-4 control-label">Password:</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">

                            <?php if( errorsHas("password") ): ?>
                                <span class="help-block">
                                    <strong><?php echo $_SESSION["errors"]["password"]; ?></strong>
                                </span>
                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="<?php echo "form-group" . ( errorsHas("password_confirm") ? " has-error" : "" );  ?>">
                        <label for="password_confirm" class="col-md-4 control-label">Confirm Password:</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password_confirm">

                            <?php if( errorsHas("password_confirm") ): ?>
                                <span class="help-block">
                                    <strong><?php echo $_SESSION["errors"]["password_confirm"]; ?></strong>
                                </span>
                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
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
        unset($_SESSION['errors']);
        unset($_SESSION['email']);
    ?>
    <?php
    //returns current buffer contents and delete current output buffer
    return ob_get_clean();
}
