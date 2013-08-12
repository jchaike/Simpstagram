<?php
include ('parameters.php');

/*******************retrieve user ID***************************/

    $url = "https://api.instagram.com/v1/users/search?q=" . $userName . "&access_token=" . $accesstoken;
	$content = file_get_contents($url);
	$result = json_decode($content, true);
	$userID = $result['data'][0]['id'];

/******************end retrieve user ID**********************/


$URL="https://api.instagram.com/v1/users/" . $userID . "/media/recent?access_token=" . $accesstoken . "&count=" . $count;

$content = file_get_contents($URL);
$json = json_decode($content, true);

foreach($json['data'] as $item) {

/*style*/
    print '<img src="' . $item['images'][$imageType]['url'] . '" width="25%" height="auto" border="0" alt="" >';
/*end styling*/

}
?>