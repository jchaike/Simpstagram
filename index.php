<?php
//Checks for theParameters.php. If it exists, include the first time setup file, if not, include instagram.php
if (!(file_exists("parameters.php")))
{
	//parameters.php does not exist. Load setup.php (setup wizard)
	include('setup.php');
}
else
{
	//parameters.php does exist, setup wizard must have already ran, load the Instagram user feed
	include('instagram.php');
}
?>
<!--
"Simpstagram" PHP Easy Script created by Josh Chaiken (jchaike)
jchaike.com
If you use this script/modify/redistribute, please keep this somewhere in the source
This script comes with absolutely no warrenty, please see README.MD for more information.
-->