(function($){
    $(document).ready(function(){
        $('.reset-password').on('click', function(event){
            event.preventDefault();
            //array of fields so we can easily hide errors in all of them
            var fields = ["email", "password", "password_confirm"];
            //key and login are hidden input fields which will be used to validate the reset link
            var key              = $('#key').val();
            var login            = $('#login').val();
            var email            = $('#email-reset-password').val();
            var password         = $('#password-reset-password').val();
            var password_confirm = $('#password_confirm-reset-password').val();

            $.ajax({
                url: reset_password_data.site_url + 'wp-json/reset-password/v1/user',
                method: 'POST',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader( 'X-WP-Nonce', reset_password_data.nonce );
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
