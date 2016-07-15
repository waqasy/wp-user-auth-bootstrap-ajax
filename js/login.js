(function($){
    $(document).ready(function(){
        $('.login').on('click', function(event){
            event.preventDefault();

            var username = $('#username-login').val();
            var password = $('#password-login').val();
            var remember = $('#remember').is(':checked');

            $.ajax({
                url: 'http://localhost:8888/coverager/wp-json/login-user/v1/user',
                method: 'POST',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader( 'X-WP-Nonce', login_user_data.nonce );
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
