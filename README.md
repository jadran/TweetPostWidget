## Setup
For this Dashboard widget to work properly you need to configure Twitter and Bit.ly from your side, please don't forget to make your Twitter app read/write.

* [Creating a Twitter app](https://github.com/twitter/ospriet/wiki/Creating-a-Twitter-app)

Make Bit.ly account and go here to grab key

* [Get Bit.ly API key](https://bitly.com/a/your_api_key)

And your site has to have twitter metatags, adding twitter meta to wordpress is out the scope here, google it.

* [Twitter MetaTags](https://dev.twitter.com/cards/types/summary)

# Register your own Twitter App to get API Keys:
- Consumer Key (API Key)			
- Consumer Secret (API Secret)
- Access Token
- Access Token Secret

# Sign in to Bit.ly and get API Key
- Bit.ly Key
- Bit.ly Login

# Edit config.php
After your got your Twitter and Bit.Ly API Keys fill config.php with appropriate data:

- $bitlyKey
- $bitlyLogin
- $consumerAPIkey
- $consumerAPIsecret
- $accessToken
- $accessTokensecret

And edit hashtag variable if you want/have hashtags for your site:

- $hashtag="#DokuMA #Makarska";

After this is done, zip the tweetwidget folder and upload as plugin in WordPress.

You will see new widget on the right side of admin dashboard, paste url of your post and click "Send Tweet".
If all API keys are correct and you have twitter metatags on your site you should see tweet on your twitter profile, if for some reason your tweet is longer than 140 it will remove hashtags from tweet, and post: title - bit.ly url - image.

I was (as many are) frustrated how bad tweets look when using JetPack Publicize with qTranslate X(or any variation of the plugin), and after numerus searchs and bad solutions(plugins) found on internet I ended coding this widget.

This widget would not be possible without marvelus jublonet codebird.php Twitter API, and wordpress.org codex site
* [Jublonet Codebird PHP Twitter API ](https://github.com/jublonet/codebird-php)
* [WordPress Codex](https://codex.wordpress.org)
Bear in mind that this widget is mine first coding for wordpress platform.

Done.

