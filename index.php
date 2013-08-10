<?php
if (!(file_exists("theParameters.php")))
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