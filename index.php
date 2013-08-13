<?php
//session_start();
//Checks for theParameters.php. If it exists, include the first time setup file, if not, include instagram.php
if (!(file_exists("parameters.php")))
{
	//theParameters.php does not exist, therefore we must set it up!
	include('setup.php');
}
else
{
	//great! everything is good to go. Lets load that Instagram stuff!
	include('instagram.php');
}
?>
<!--
"Simpstagram" PHP Easy Script created by Josh Chaiken (jchaike)
jchaike.com
If you use this script/modify/redistribute, please keep this somewhere in the source
This script comes with absolutely no warrenty, please see README.MD for more information.
-->