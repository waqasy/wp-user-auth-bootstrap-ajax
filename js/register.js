(function($){
    $(document).ready(function(){
        $('.register').on('click', function(event){
            event.preventDefault();
            //array of fields so we can easily hide errors in all of them
            var fields = ["username", "email", "password", "password_confirm"]

            var username         = $('#username').val();
            var email            = $('#email').val();
            var password         = $('#password').val();
            var password_confirm = $('#password_confirm').val();

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
                location.reload();
            }).fail(function(data){
                //We want to reset all error
                fields.map(function(field){
                    hide_errors(field);
                });
                var response = JSON.parse(data.responseText);
                var errors   = response.message;
                for (error in errors) {
                    show_errors(error, errors[error]);
                }
                console.log("errors are: ", errors);
            });
        });

        function show_errors(field, error_message) {
            $('.'+field).addClass('has-error');
            $('.'+field+'-error').removeClass('hidden');
            $('.'+field+'-error-text').text(error_message);
        }

        function hide_errors(field) {
            $('.'+field).removeClass('has-error');
            $('.'+field+'-error').addClass('hidden');
            $('.'+field+'-error-text').text('');
        }
    });
})(jQuery);
