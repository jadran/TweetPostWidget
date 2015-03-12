<?php
/* Load config.php with api keys */
require_once('config.php');

/* POST input_url data */
$input_url = $_POST["post_url"];
if (!filter_var($input_url, FILTER_VALIDATE_URL)) 
	{
	 echo '<p style="margin: 5px;">URL is invalid</p>';
   	 exit;
	}

/* GET MetaData from link */
$meta_url=get_meta_tags("$input_url");
$title=($meta_url['twitter:title']);
$image=($meta_url['twitter:image:src']);
$space=" ";
/* CHECK if we have MetaData in post */
if(is_null($title))
    {
	  echo '<p style="margin: 5px;">No Meta Tags in post</p>';
      exit;
    }
	
/* THE MUST: Fix Title Qoutation Marks */
$clean_title=str_replace(
	// &#8216; - LEFT SINGLE QUOTATION MARK  -> '
	// &#8217; - RIGHT SINGLE QUOTATION      -> ' 
	// &#8220; - LEFT DOUBLE QUOTATION MARK  -> "
	// &#8221; - RIGHT DOUBLE QUOTATION MARK -> "
	//       “ - LEFT DOUBLE QUOTATION MARK  -> "
	//       ” - RIGHT DOUBLE QUOTATION MARK -> "
	//       ’ - LEFT SINGLE  MARK 			 -> '
	//       ‘ - RIGHT SINGLE  MARK 		 -> '
	array('&#8216;', '&#8217;', '&#8220;', '&#8221;','“','”','’','‘'),
	array("'","'",'','','','',"'","'"),
	$title
); 
	
/* START Bit.Ly PHP API */
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
$bitly_shorturl = make_bitly_url($input_url, $bitlyLogin, $bitlyKey,'json');

/* CHECK did we generated bit.ly url */
if(is_null($bitly_shorturl))
	{
		echo '<p style="margin: 5px;">Bit.Ly not generated, check API keys</p>';
		exit;
	}

/* Create Tweet from metadata and bit.ly variables */
$tweet=$clean_title . $space . $hashtag  . $space . $bitly_shorturl;

/* CHECK Tweet size */
if (strlen($tweet)>140) 
	{
   	 	echo '<p style="margin: 5px;">Tweet is to big removing hahstags...</p>';
    	$tweet=$clean_title . $space . $bitly_shorturl;
    	echo '<p style="margin: 5px;">' . $tweet . '</p>';
	} 
else 
	{
 		echo '<p style="margin: 5px;">' . $tweet . '</p>';
	}

/* START: CodeBird Twitter PHP API */
require_once('api/codebird.php');
\Codebird\Codebird::setConsumerKey($consumerAPIkey, $consumerAPIsecret);
$cb = \Codebird\Codebird::getInstance();
$cb->setToken($accessToken, $accessTokensecret);
 
$params = array(
  'status' => $tweet,
  'media[]' => $image
);
$reply = $cb->statuses_updateWithMedia($params);

/* CHECK tweet http status and did we realy posted it / 200(ok) 400(not)*/
$tweet_status = $reply->httpstatus;
if ($type == 200) 
	{
		echo '<p class="response" style="margin: 5px; text-align: right;">Tweet Posted</p>';
	} 
else 
	{
		echo '<p class="response" style="margin: 5px; text-align: right;">Tweet Not Posted, check API keys</p>';	
	} 
?>