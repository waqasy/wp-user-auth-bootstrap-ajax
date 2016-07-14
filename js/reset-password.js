(function($){
    $(document).ready(function(){
        $('.reset-password').on('click', function(event){
            event.preventDefault();
            //array of fields so we can easily hide errors in all of them
            var fields = ["email", "password", "password_confirm"];

            var key              = $('#key').val();
            var login            = $('#login').val();
            var email            = $('#email').val();
            var password         = $('#password').val();
            var password_confirm = $('#password_confirm').val();

            $.ajax({
                url: 'http://localhost:8888/coverager/wp-json/reset-password/v1/user',
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
            $('.'+field).addClass('has-error');
            $('.'+field+'-error').removeClass('hidden');
            $('.'+field+'-error-text').html(error_message);
        }

        function hide_errors(field) {
            $('.'+field).removeClass('has-error');
            $('.'+field+'-error').addClass('hidden');
            $('.'+field+'-error-text').text('');
        }
    });
})(jQuery);
