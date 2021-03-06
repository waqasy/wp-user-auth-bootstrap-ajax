<?php

function uab_update_password_form()
{
    ?>

    <div class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
        <div class="panel panel-primary">
            <div class="panel-heading">Update Password</div>
            <div class="panel-body">

                <?php
                    if( !is_user_logged_in() )
                    {
                        return wp_redirect( network_site_url( '/' ) );
                    }
                    $current_user = wp_get_current_user();
                ?>

                <div class="alert alert-danger update-password-server-error hidden">
                </div>

                <div class="alert alert-success update-password-success hidden">
                </div>

                <form class="form-horizontal" method="post">

                    <div class="form-group current_password-update">
                        <label for="password" class="col-md-4 control-label">Current Password:</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="current_password-update" name="current_password">

                            <span class="help-block current_password-update-error hidden">
                                <strong class="current_password-update-error-text"></strong>
                            </span>

                        </div>
                    </div>

                    <div class="form-group new_password-update">
                        <label for="password" class="col-md-4 control-label">New Password:</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="new_password-update" name="new_password">

                            <span class="help-block new_password-update-error hidden">
                                <strong class="new_password-update-error-text"></strong>
                            </span>

                        </div>
                    </div>

                    <div class="form-group password_confirm-update">
                        <label for="password_confirm" class="col-md-4 control-label">Confirm Password:</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password_confirm-update" name="password_confirm">

                            <span class="help-block password_confirm-update-error hidden">
                                <strong class="password_confirm-update-error-text"></strong>
                            </span>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary update-password">
                                <i class="fa fa-btn fa-user"></i> Update
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php

}


?>
