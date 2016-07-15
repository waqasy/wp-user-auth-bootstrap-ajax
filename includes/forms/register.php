<?php
function uab_register_form()
{
    ?>

    <div class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
        <div class="panel panel-primary">
            <div class="panel-heading">Register</div>
            <div class="panel-body">

                <div class="alert alert-danger registration-server-error hidden">
                </div>

                <form class="form-horizontal" method="post">

                    <div class="form-group username-registration">
                        <label for="username" class="col-md-4 control-label">Username:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="username-registration" name="username">

                            <span class="help-block username-registration-error hidden">
                                <strong class="username-registration-error-text"></strong>
                            </span>

                        </div>
                    </div>

                    <div class="form-group email-registration">
                        <label for="email" class="col-md-4 control-label">Email:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="email-registration" name="email">

                            <span class="help-block email-registration-error hidden">
                                <strong class="email-registration-error-text"></strong>
                            </span>

                        </div>
                    </div>

                    <div class="form-group password-registration">
                        <label for="password" class="col-md-4 control-label">Password:</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password-registration" name="password">

                            <span class="help-block password-registration-error hidden">
                                <strong class="password-registration-error-text"></strong>
                            </span>

                        </div>
                    </div>

                    <div class="form-group password_confirm-registration">
                        <label for="password_confirm" class="col-md-4 control-label">Confirm Password:</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password_confirm-registration" name="password_confirm">

                            <span class="help-block password_confirm-registration-error hidden">
                                <strong class="password_confirm-registration-error-text"></strong>
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

}
