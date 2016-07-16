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
