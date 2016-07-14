<?php

function login_form()
{
    ?>

    <div class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
        <div class="panel panel-primary">
            <div class="panel-heading">Login</div>
            <div class="panel-body">

                <div class="alert alert-danger login-error hidden">
                </div>

                <div class="alert alert-success login-success hidden">
                </div>

                <form action="http://localhost:8888/coverager/wp-json/login-user/v1/user" class="form-horizontal" method="post">

                    <div class="form-group">
                        <label for="username" class="col-md-4 control-label">Username:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Password:</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="remember" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary login">
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

}

 ?>
