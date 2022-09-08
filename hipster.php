<?
// truncation function
function truncateString($str, $chars, $to_space, $replacement="...") {
    if($chars > strlen($str)) return $str;

    $str = substr($str, 0, $chars);
    $space_pos = strrpos($str, " ");
    if($to_space && $space_pos >= 0) 
    $str = substr($str, 0, strrpos($str, " "));

    return($str . $replacement);
}


// minor settings
$hashTag = "#hipsterbot";
$hashLength = strlen($hashTag);
$tweetLength = 140; // can change this, but currently set to old Twitter standards
$maxLength = $tweetLength - $hashLength;

// Rewriting the Hipsterbot in PHP because, well, cleaner.
$apiResults = file_get_contents("http://hipsum.co/api/?type=hipster-centric&paras=1&html=false");
$jsonSpew = json_decode($apiResults, true);


// Time to manipulate
$coreData = ucfirst($jsonSpew[0]);
$myTweet = truncateString($coreData, $maxLength, TRUE, '.').' '.$hashTag;

// Execute the tweet
$command = "t update '".$myTweet."'";
exec ($command);

?>