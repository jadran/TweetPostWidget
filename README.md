For this plugin to work you need Twitter and Bit.ly configured from your side:

# Make Twitter App to get API Keys:
- Consumer Key (API Key)			
- Consumer Secret (API Secret)
- Access Token
- Access Token Secret

# Sign in to Bit.ly to get API Key
- Bit.ly Key
- Bit.ly Login

# After You have your API Keys edit twitterpost.php
/* Your Bit.Ly Keys:  */
$bitlyKey          = "R_XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
$bitlyLogin        = "yourloginname";

/* Your Twitter Keys: */			  
$consumerAPIkey    = "XXXXXXXXXXXXXXXXXXXXXXXXX";
$consumerAPIsecret = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
$accessToken       = "XXXXXXXXXX-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
$accessTokensecret = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";

# And edit hashtag variable if you have hashtag for your site.
$hashtag="#DokuMA #Makarska";


After this is done, zip the tweetwidget folder and upload as plugin in WordPress.

