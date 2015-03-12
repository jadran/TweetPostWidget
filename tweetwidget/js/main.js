jQuery(document).ready(function($) {

    $("#submit-url-button").click(function() {
        var valid;
        valid = validateTweet();
        if (valid) {
            jQuery.ajax({
                url: (url.twitterpost_path), // twitterpost.php url from localized variable in tweet_widget.php
                data: 'post_url=' + $("#post_url").val(),
                type: "POST",
                success: function(data) {
                    $("#tweet-status").html(data); // fill html with data given by twitterpost.php
                },
                error: function() {}
            });
        }

        function validateTweet() {
            var valid = true;
            if (!$("#post_url").val()) {
                $("#post_url").css('background-color', '#FFFFDF'); // change color if no url link provided in textbox
                valid = false;
            } else {
                $("#tweet-status").html('<p style="margin: 5px;">(processing...)</p>'); // write processing in html while php running on server
                return valid;
            }
        }
    })
});