<?php 
//code from The Web Dev Door by Tom Elliott
//Adapted by Siobhan Schnittger 
//http://www.webdevdoor.com/php/authenticating-twitter-feed-timeline-oauth/

session_start();
require_once("twitteroauth/twitteroauth.php"); //Path to twitteroauth library

$type="user_timeline";
$q="";

if( isset($_GET) && isset($_GET['type']) && isset($_GET['q']) ){
	$q=$_GET['q'];
	$type=$_GET['type'];
}
 
$twitteruser = "thisdigitalinc";
$notweets = 30;
$consumerkey = "oXRHpijPXqkmpI01vB3XKQ";
$consumersecret = "EBxsXvSZaDeiN08kHHtWaiiZyiGOdpsIP0UGBwy2g";
$accesstoken = "1615587769-mhzmHR2bWQVlueppiW1mjwkrGMdGdw4qmoC6IMU";
$accesstokensecret = "AcKfb0CjRi3mun0dpFQAhubh4Br8hLmlwac8G4IDJE";
 
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
 
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);

$tweets = '';
if($type == 'search'){
	$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json?count=".$notweets."&q=".$q);
}
else {
	$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
}
echo json_encode($tweets);
?>



