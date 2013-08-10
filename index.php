<?php
//$homepage = file_get_contents('firstRun.txt');
if (!(file_exists("theParameters.php")))
//if (!($homepage=="false"))
{
	//first time setup
	include('setup.php');
}
else
{
	//its not the first setup, meaning parameters have been set.
	include('instagram.php');
}




?>

<!--

https://api.instagram.com/oauth/authorize/?client_id=39318d8c7d3f430fb27ba26da18fdb38&redirect_uri=http://www.jchaike.com/instagram&response_type=code

-->