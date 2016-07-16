(function($){
    $(document).ready(function(){
        $('.send-reset-link').on('click', function(event){
            event.preventDefault();

            var email = $('#email-reset-link').val();

            $.ajax({
                url: uab_data.site_url + 'wp-json/reset-link/v1/user',
                method: 'POST',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader( 'X-WP-Nonce', uab_data.nonce );
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
