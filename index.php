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