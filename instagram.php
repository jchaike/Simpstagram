<?php
include ('parameters.php');

	//retrieve user ID
    $url = "https://api.instagram.com/v1/users/search?q=" . $userName . "&access_token=" . $accesstoken;
	$content = file_get_contents($url);
	$result = json_decode($content, true);
	$userID = $result['data'][0]['id'];

$URL="https://api.instagram.com/v1/users/" . $userID . "/media/recent?access_token=" . $accesstoken . "&count=" . $count;

$content = file_get_contents($URL);
$json = json_decode($content, true);

foreach($json['data'] as $item) {

	//Edit the styling here
    print '<img src="' . $item['images'][$imageType]['url'] . '" width="25%" height="auto" border="0" alt="" >';
}
?>

<!--
"Simpstagram" PHP Easy Script created by Josh Chaiken (jchaike)
jchaike.com
If you use this script/modify/redistribute, please keep this somewhere in the source
This script comes with absolutely no warrenty, please see README.MD for more information.
-->