jQuery(document).ready(function($) {

	$( "#submit-url-button" ).click(function() {
  	var valid;	
  	valid = validateTweet();
  	if(valid) {
  		jQuery.ajax({
  		url: "../wp-content/plugins/tweetwidget/twitterpost.php",
  		data:'post_url='+$("#post_url").val(),
  		type: "POST",
  		success:function(data){
  		$("#tweet-status").html(data);
  		},
  		error:function (){}
  		});
  	   }

  	function validateTweet() {
  	var valid = true;
  	if(!$("#post_url").val()) {
  		$("#post_url").css('background-color','#FFFFDF');
  		valid = false;
  	} else  {
  	$("#tweet-status").html("(processing...)");	
  	return valid;
  	}
  	}
	
	})

});