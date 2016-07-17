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
