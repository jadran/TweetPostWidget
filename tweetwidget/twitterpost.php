<?php
/* Load config.php with api keys */
require_once ('config.php');

/* GET data from input_url */
$input_url = $_POST["post_url"];
/* CHECK if data from input_url is valid URL */

if (!filter_var($input_url, FILTER_VALIDATE_URL))
{
	echo '<p style="margin: 5px;">URL is invalid</p>';
	exit;
}

/* GET MetaData from link */
$meta_url = get_meta_tags("$input_url");
$title = ($meta_url['twitter:title']);
$image = ($meta_url['twitter:image:src']);
$space = " ";
/* CHECK if we have MetaData in post */

if (is_null($title))
{
	echo '<p style="margin: 5px;">No Meta Tags in post</p>';
	exit;
}

/* THE MUST: proper UTF8 handling of raw text */
$utf8_title = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $title); 
	
/* START: Bit.Ly PHP API */
function make_bitly_url($url,$login,$appkey,$format = 'xml',$version = '2.0.1')
{
	$bitly = 'http://api.bit.ly/shorten?version='.$version.'&longUrl='.urlencode($url).'&login='.$login.'&apiKey='.$appkey.'&format='.$format;
	
	$response = file_get_contents($bitly);

	if(strtolower($format) == 'json')
	{
		$json = @json_decode($response,true);
		return $json['results'][$url]['shortUrl'];
	}
	else 
	{
		$xml = simplexml_load_string($response);
		return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
	}
}
$bitly_shorturl = make_bitly_url($input_url, $bitlyLogin, $bitlyKey,'json'); 	// make shorturl with bitly Keys from config.php

/* CHECK did we generated bit.ly url */
if (is_null($bitly_shorturl))
{
	echo '<p style="margin: 5px;">Bit.Ly not generated, check API keys in config.php</p>';
	exit;
}

/* Create Tweet from metadata and bit.ly variables */
$tweet=$utf8_title . $space . $hashtag  . $space . $bitly_shorturl;

/* CHECK Tweet size */
if (strlen($tweet)>140) 
{
		/* Tweet size bigger than 140 characters, try to remove hashtags and still post tweet */
    	echo '<p style="margin: 5px;">Tweet is to big removing hahstags...</p>';
    	$tweet=$utf8_title . $space . $bitly_shorturl;
} 

/* START: CodeBird Twitter PHP API */
require_once('api/codebird.php'); 						// if we came to here, load codebird.php Tweet API and start Tweet post
\Codebird\Codebird::setConsumerKey($consumerAPIkey, $consumerAPIsecret);	// set consumerAPI Keys from config.php
$cb = \Codebird\Codebird::getInstance();
$cb->setToken($accessToken, $accessTokensecret);				// set accessTokens from config.php
 
$params = array(
  'status' => $tweet,
  'media[]' => $image
);

$reply = $cb->statuses_updateWithMedia($params);

/* CHECK Tweet http status / 200(ok) 400(not) */
$tweet_status = $reply->httpstatus;
if ($tweet_status == 200) 
{
	/* status 200(ok) */
	echo '<p style="margin: 5px;">' . $tweet . '</p>';
	// echo '<img src="' . $image . '" style="width:100%;">';
	echo '<p class="response" style="margin: 5px; text-align: right;">Tweet Posted</p>';
} 
else 
{
	/* else status 400(not ok) */
	echo '<p class="response" style="margin: 5px; text-align: right;">Tweet Not Posted, check API keys in config.php</p>';	
} 
?>