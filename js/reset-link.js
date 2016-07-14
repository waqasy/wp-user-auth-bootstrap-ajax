(function($){
    $(document).ready(function(){
        $('.send-reset-link').on('click', function(event){
            event.preventDefault();

            var email = $('#email').val();

            $.ajax({
                url: 'http://localhost:8888/coverager/wp-json/reset-link/v1/user',
                method: 'POST',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader( 'X-WP-Nonce', reset_link_data.nonce );
                },
                data: {
                    email: email,
                }
            }).done(function(data){
                console.log("data is: ", data);
                $(".reset-link-error").addClass("hidden");
                $(".reset-link-success").removeClass("hidden");
                $(".reset-link-success").text(data);
            }).fail(function(data){
                var response = JSON.parse(data.responseText);
                var error    = response.message;
                $(".reset-link-success").addClass("hidden");
                $(".reset-link-error").removeClass("hidden");
                $(".reset-link-error").text(error);
                console.log("errors are: ", error);
            });
        });
    });
})(jQuery);
