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
                url: 'http://localhost:8888/coverager/wp-json/registering-user/v1/user',
                method: 'POST',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader( 'X-WP-Nonce', register_user_data.nonce );
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
