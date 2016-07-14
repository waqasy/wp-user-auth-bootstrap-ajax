<?php
function register_form()
{
    ob_start(); ?>

    <div class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
        <div class="panel panel-primary">
             <div class="panel-heading">Register</div>
             <div class="panel-body additional-fields-panel">

                <form action="http://localhost:8888/coverager/wp-json/registering-user/v1/user" class="form-horizontal" method="post">

                    <div class="form-group username">
                        <label for="username" class="col-md-4 control-label">Username:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="username" name="username">

                            <span class="help-block username-error hidden">
                                <strong class="username-error-text"></strong>
                            </span>

                        </div>
                    </div>

                    <div class="form-group email">
                        <label for="email" class="col-md-4 control-label">Email:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="email" name="email" value="<?php old("email") ?>">

                            <span class="help-block email-error hidden">
                                <strong class="email-error-text"></strong>
                            </span>

                        </div>
                    </div>

                    <div class="form-group password">
                        <label for="password" class="col-md-4 control-label">Password:</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password" name="password">

                            <span class="help-block password-error hidden">
                                <strong class="password-error-text"></strong>
                            </span>

                        </div>
                    </div>

                    <div class="form-group password_confirm">
                        <label for="password_confirm" class="col-md-4 control-label">Confirm Password:</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm">

                            <span class="help-block password_confirm-error hidden">
                                <strong class="password_confirm-error-text"></strong>
                            </span>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary register">
                                <i class="fa fa-btn fa-user"></i> Register
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php
    //returns current buffer contents and delete current output buffer
    return ob_get_clean();
}
