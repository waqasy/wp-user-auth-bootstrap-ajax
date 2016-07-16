<?php

function uab_update_user_form()
{
    ?>

    <div class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
        <div class="panel panel-primary">
            <div class="panel-heading">Update Profile</div>
            <div class="panel-body">

                <?php
                    if( !is_user_logged_in() )
                    {
                        return wp_redirect( network_site_url( '/' ) );
                    }
                    $current_user = wp_get_current_user();

                ?>

                <div class="alert alert-danger update-server-error hidden">
                </div>

                <div class="alert alert-success update-success hidden">
                </div>

                <form class="form-horizontal" method="post">

                    <div class="form-group username-update">
                        <label for="username" class="col-md-4 control-label">Username:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="username-update" name="username" value="<?php echo $current_user->user_login ?>">

                            <span class="help-block username-update-error hidden">
                                <strong class="username-update-error-text"></strong>
                            </span>

                        </div>
                    </div>

                    <div class="form-group email-update">
                        <label for="email" class="col-md-4 control-label">Email:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="email-update" name="email" value="<?php echo $current_user->user_email ?>">

                            <span class="help-block email-update-error hidden">
                                <strong class="email-update-error-text"></strong>
                            </span>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary update">
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
