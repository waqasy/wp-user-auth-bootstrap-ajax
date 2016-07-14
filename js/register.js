(function($){
    $(document).ready(function(){
        $('.register').on('click', function(event){
            event.preventDefault();

            var username         = $('#username').val();
            var email            = $('#email').val();
            var password         = $('#password').val();
            var password_confirm = $('#password_confirm').val();

            console.log("username is: ", username);
            console.log("email is: ", email);
            console.log("password is: ", password);
            console.log("password_confirm is: ", password_confirm);

            hide_errors('username');
            var username = $('#username').val();
            console.log(username);

            // if(username.length < 3) {
            //     show_errors("username", "Username must be at least 3 characters");
            // }

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
                conole.log("data is: ", data);
            }).fail(function(data){
                var response = JSON.parse(data.responseText);
                var errors = response.message;
                for (error in errors) {
                    show_errors(error, errors[error])
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
