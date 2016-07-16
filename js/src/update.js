(function($){
    $(document).ready(function(){
        $('.update').on('click', function(event){
            event.preventDefault();
            //array of fields so we can easily hide errors in all of them
            var fields = ["username", "email", "password", "password_confirm"];

            var username         = $('#username-update').val();
            var email            = $('#email-update').val();
            var password         = $('#password-update').val();
            var password_confirm = $('#password_confirm-update').val();

            $.ajax({
                url: uab_data.site_url + 'wp-json/update-user/v1/user',
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
            $('.'+field+'-update-error-text').text(error_message);
        }

        function hide_errors(field) {
            $('.'+field+'-update').removeClass('has-error');
            $('.'+field+'-update-error').addClass('hidden');
            $('.'+field+'-update-error-text').text('');
        }
    });
})(jQuery);
