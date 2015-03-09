<?php
/* GET App Keys from Twitter and Bit.Ly */

/* Your Bit.Ly Keys:  */
$bitlyKey          = "R_XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
$bitlyLogin        = "yourloginname";

/* Your Twitter Keys: */			  
$consumerAPIkey    = "XXXXXXXXXXXXXXXXXXXXXXXXX";
$consumerAPIsecret = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
$accessToken       = "XXXXXXXXXX-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
$accessTokensecret = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";

/* Your HashTags */
$hashtag="#DokuMA #Makarska";

/* POST input_url data */
$input_url = $_POST["post_url"];

/* GET MetaData from link */
$meta_url=get_meta_tags("$input_url");
$title=($meta_url['twitter:title']);
$image=($meta_url['twitter:image:src']);
$space=" ";

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

/* START Bit.Ly URL PHP API */
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

/* Create Tweet form from metadata and bit.ly variables */
$tweet=$clean_title . $space . $hashtag  . $$space . $bitly_shorturl;
print $tweet;	
	
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
print "<p align='right' class='response'>Tweet Posted</p>";
?>