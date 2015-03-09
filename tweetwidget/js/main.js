function sendTweet() {
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
}

function validateTweet() {
	var valid = true;
	$("#tweet-status").html("(processing...)");	
	
	if(!$("#post_url").val()) {
		$("#post_url-info").html("(paste url)");
		$("#post_url").css('background-color','#FFFFDF');
		valid = false;
	}
	return valid;
}