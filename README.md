For this plugin to work you need to configure Twitter and Bit.ly from your side:
And your site has to have twitter metatags, adding twitter meta is out of the scope here, google it.

"twitter:title"
"twitter:image:src"

# Make Twitter App to get API Keys:
- Consumer Key (API Key)			
- Consumer Secret (API Secret)
- Access Token
- Access Token Secret

# Sign in to Bit.ly and get API Key
- Bit.ly Key
- Bit.ly Login

# After You have your API Keys edit config.php

$bitlyKey 

$bitlyLogin

$consumerAPIkey

$consumerAPIsecret

$accessToken

$accessTokensecret

# And edit hashtag variable if you have hashtags for your site.
$hashtag="#DokuMA #Makarska";


After this is done, zip the tweetwidget folder and upload as plugin in WordPress.

You will see new widget on the right side of admin dashboard, paste url in text box and click "Send Tweet"
If all api keys are correct and you have twitter metatags on your site you should see tweet on your twitter profile.

Done.

