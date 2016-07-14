(function($){
    $(document).ready(function(){
        $('.register').on('click', function(event){
            event.preventDefault();
            hide_errors('username');
            var username = $('#username').val();
            console.log(username);

            if(username.length < 3) {
                show_errors("username", "Username must be at least 3 characters");
            }
            return;
            $.ajax({
                url: 'http://localhost:8888/coverager/wp-json/registering-user/v1/user',
                method: 'POST',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader( 'X-WP-Nonce', register_user_data.nonce );
                },
                data: {
                    username: "Johnny",
                    email: "johnny@johnny.com"
                }
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
