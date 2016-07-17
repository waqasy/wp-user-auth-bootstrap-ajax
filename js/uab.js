(function($){
    $(document).ready(function(){
        $('.login').on('click', function(event){
            event.preventDefault();

            var username = $('#username-login').val();
            var password = $('#password-login').val();
            var remember = $('#remember').is(':checked');

            $.ajax({
                url: uab_data.site_url + 'wp-json/login-user/v1/user',
                method: 'POST',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader( 'X-WP-Nonce', uab_data.nonce );
                },
                data: {
                    username: username,
                    password: password,
                    remember: remember
                }
            }).done(function(data){
                console.log("data is: ", data);
                $(".login-error").addClass("hidden");
                $(".login-success").removeClass("hidden");
                $(".login-success").text(data);
            }).fail(function(data){
                var response = JSON.parse(data.responseText);
                var error    = response.message;
                $(".login-error").removeClass("hidden");
                $(".login-error").text(error);
                console.log("errors are: ", error);
            });
        });
    });
})(jQuery);

(function($){
    $(document).ready(function(){
        $('.register').on('click', function(event){
            event.preventDefault();
            //array of fields so we can easily hide errors in all of them
            var fields = ["username", "email", "password", "password_confirm"];

            var username         = $('#username-registration').val();
            var email            = $('#email-registration').val();
            var password         = $('#password-registration').val();
            var password_confirm = $('#password_confirm-registration').val();

            $.ajax({
                url: uab_data.site_url + 'wp-json/registering-user/v1/user',
                method: 'POST',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader( 'X-WP-Nonce', uab_data.nonce );
                },
                data: {
                    username: username,
                    email: email,
                    password: password,
                    password_confirm: password_confirm
                }
            }).done(function(data){
                console.log("data is: ", data);
            }).fail(function(data){
                //We want to reset all errors in exchange of possible new ones
                fields.map(function(field){
                    hide_errors(field);
                });
                $(".registration-server-error").addClass("hidden");

                var response = JSON.parse(data.responseText);
                //This will run incase of an unexpected error.
                if(response.code === 'server_error') {
                    $(".registration-server-error").removeClass("hidden");
                    $(".registration-server-error").text(response.message);
                };
                //We assign the errors object and loop over it to show the errors.
                var errors = response.message;
                for (error in errors) {
                    show_errors(error, errors[error]);
                }
                console.log("errors are: ", errors);
            });
        });

        function show_errors(field, error_message) {
            $('.'+field+'-registration').addClass('has-error');
            $('.'+field+'-registration-error').removeClass('hidden');
            $('.'+field+'-registration-error-text').text(error_message);
        }

        function hide_errors(field) {
            $('.'+field+'-registration').removeClass('has-error');
            $('.'+field+'-registration-error').addClass('hidden');
            $('.'+field+'-registration-error-text').text('');
        }
    });
})(jQuery);

(function($){
    $(document).ready(function(){
        $('.send-reset-link').on('click', function(event){
            event.preventDefault();

            var email = $('#email-reset-link').val();

            $.ajax({
                url: uab_data.site_url + 'wp-json/reset-link/v1/user',
                method: 'POST',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader( 'X-WP-Nonce', uab_data.nonce );
                },
                data: {
                    email: email,
                }
            }).done(function(data){
                console.log("data is: ", data);
                $(".reset-link-error").addClass("hidden");
                $(".reset-link-success").removeClass("hidden");
                $(".reset-link-success").text(data);
            }).fail(function(data){
                var response = JSON.parse(data.responseText);
                var error    = response.message;
                $(".reset-link-success").addClass("hidden");
                $(".reset-link-error").removeClass("hidden");
                $(".reset-link-error").text(error);
                console.log("errors are: ", error);
            });
        });
    });
})(jQuery);

(function($){
    $(document).ready(function(){
        $('.reset-password').on('click', function(event){
            event.preventDefault();
            //array of fields so we can easily hide errors in all of them
            var fields = ["email", "password", "password_confirm"];
            //key and login are hidden input fields which will be used to validate the reset link
            var key              = uab_data.key
            var login            = uab_data.login
            var email            = $('#email-reset-password').val();
            var password         = $('#password-reset-password').val();
            var password_confirm = $('#password_confirm-reset-password').val();

            $.ajax({
                url: uab_data.site_url + 'wp-json/reset-password/v1/user',
                method: 'POST',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader( 'X-WP-Nonce', uab_data.nonce );
                },
                data: {
                    key: key,
                    login: login,
                    email: email,
                    password: password,
                    password_confirm: password_confirm
                }
            }).done(function(data){
                fields.map(function(field){
                    hide_errors(field);
                });
                $(".reset-password-success").removeClass("hidden");
                $(".reset-password-success").html(data);
                console.log("data is: ", data);
            }).fail(function(data){
                //We want to reset all error
                fields.map(function(field){
                    hide_errors(field);
                });
                var response = JSON.parse(data.responseText);
                $(".reset-password-error").addClass("hidden");
                if(response.code === 'invalid_reset_link') {
                    $(".reset-password-error").removeClass("hidden");
                    $(".reset-password-error").html(response.message);
                };
                var errors = response.message;
                for (error in errors) {
                    show_errors(error, errors[error]);
                }
                console.log("errors are: ", errors);
            });
        });

        function show_errors(field, error_message) {
            $('.'+field+'-reset-password').addClass('has-error');
            $('.'+field+'-reset-password-error').removeClass('hidden');
            $('.'+field+'-reset-password-error-text').html(error_message);
        }

        function hide_errors(field) {
            $('.'+field+'-reset-password').removeClass('has-error');
            $('.'+field+'-reset-password-error').addClass('hidden');
            $('.'+field+'-reset-password-error-text').text('');
        }
    });
})(jQuery);

(function($){
    $(document).ready(function(){
        $('.update-password').on('click', function(event){
            event.preventDefault();
            //array of fields so we can easily hide errors in all of them
            var fields = ["current_password", "new_password", "password_confirm"];

            var current_password = $('#current_password-update').val();
            var new_password     = $('#new_password-update').val();
            var password_confirm = $('#password_confirm-update').val();

            $.ajax({
                url: uab_data.site_url + 'wp-json/update-password/v1/user',
                method: 'POST',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader( 'X-WP-Nonce', uab_data.nonce );
                },
                data: {
                    user_id: uab_data.user_id,
                    current_password: current_password,
                    new_password: new_password,
                    password_confirm: password_confirm
                }
            }).done(function(data){
                console.log("data is: ", data);
                //Hide all error messages
                fields.map(function(field){
                    hide_errors(field);
                });
                $(".update-password-server-error").addClass("hidden");

                $(".update-password-success").removeClass("hidden");
                $(".update-password-success").text(data);
            }).fail(function(data){
                //Incase user updates again after success
                $(".update-password-success").addClass("hidden");
                //Reset all errors in exchange of possible new ones
                fields.map(function(field){
                    hide_errors(field);
                });
                $(".update-password-server-error").addClass("hidden");

                var response = JSON.parse(data.responseText);
                //This will run incase of an unexpected error.
                if(response.code === 'server_error') {
                    $(".update-password-server-error").removeClass("hidden");
                    $(".update-password-server-error").text(response.message);
                };
                //We assign the errors object and loop over it to show the errors.
                var errors = response.message;
                for (error in errors) {
                    show_errors(error, errors[error]);
                }
                console.log("errors are: ", errors);
            });
        });

        function show_errors(field, error_message) {
            $('.'+field+'-update').addClass('has-error');
            $('.'+field+'-update-error').removeClass('hidden');
            $('.'+field+'-update-error-text').html(error_message);
        }

        function hide_errors(field) {
            $('.'+field+'-update').removeClass('has-error');
            $('.'+field+'-update-error').addClass('hidden');
            $('.'+field+'-update-error-text').text('');
        }
    });
})(jQuery);

(function($){
    $(document).ready(function(){
        $('.update').on('click', function(event){
            event.preventDefault();
            //array of fields so we can easily hide errors in all of them
            var fields = ["username", "email", "current_password", "new_password", "password_confirm"];
            
            var user_id          = uab_data.user_id;
            var username         = $('#username-update').val();
            var email            = $('#email-update').val();
            var current_password = $('#current_password-update').val();
            var new_password     = $('#new_password-update').val();
            var password_confirm = $('#password_confirm-update').val();

            $.ajax({
                url: uab_data.site_url + 'wp-json/update-user/v1/user',
                method: 'POST',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader( 'X-WP-Nonce', uab_data.nonce );
                },
                data: {
                    user_id: user_id,
                    username: username,
                    email: email,
                    current_password: current_password,
                    new_password: new_password,
                    password_confirm: password_confirm
                }
            }).done(function(data){
                console.log("data is: ", data);
                //Hide all error messages
                fields.map(function(field){
                    hide_errors(field);
                });
                $(".update-server-error").addClass("hidden");

                $(".update-success").removeClass("hidden");
                $(".update-success").text(data.success);
                //If username has changed we need to login the user again, because WordPress just logged him out.
                if(data.username_changed){
                    login_user(user_id);
                } else {
                    $( "#wpadminbar" ).load( "../coverager/lostpassword #wpadminbar" );
                }
            }).fail(function(data){
                //Incase user updates again after success
                $(".update-success").addClass("hidden");
                //Reset all errors in exchange of possible new ones
                fields.map(function(field){
                    hide_errors(field);
                });
                $(".update-server-error").addClass("hidden");

                var response = JSON.parse(data.responseText);
                //This will run incase of an unexpected error.
                if(response.code === 'server_error') {
                    $(".update-server-error").removeClass("hidden");
                    $(".update-server-error").text(response.message);
                };
                //We assign the errors object and loop over it to show the errors.
                var errors = response.message;
                for (error in errors) {
                    show_errors(error, errors[error]);
                }
                console.log("errors are: ", errors);
            });
        });

        function show_errors(field, error_message) {
            $('.'+field+'-update').addClass('has-error');
            $('.'+field+'-update-error').removeClass('hidden');
            $('.'+field+'-update-error-text').html(error_message);
        }

        function hide_errors(field) {
            $('.'+field+'-update').removeClass('has-error');
            $('.'+field+'-update-error').addClass('hidden');
            $('.'+field+'-update-error-text').text('');
        }

        function login_user(id) {
            $.post(uab_data.site_url + 'wp-json/login-user/v1/user', { id: id, after_update: true })
                .done(function( data ) {
                    console.log(data);
                    location.reload();
                    console.log("User is logged in again");
                });
        }

    });
})(jQuery);
