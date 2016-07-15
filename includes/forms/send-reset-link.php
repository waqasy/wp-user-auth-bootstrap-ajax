<?php

function uab_request_password_reset_form()
{
    ?>

    <div class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
        <div class="panel panel-primary">
             <div class="panel-heading">Reset Password</div>
             <div class="panel-body">

                <div class="alert alert-success reset-link-success hidden">
                </div>

                <div class="alert alert-danger reset-link-error hidden">
                </div>

                <form class="form-horizontal" method="post">

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Email:</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="email-reset-link" name="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary send-reset-link">
                                <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
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
