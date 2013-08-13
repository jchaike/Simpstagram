<?php
session_start();

if (isset($_POST["send"]))
{
	$_SESSION['clientID']=$_POST['clientID'];
	$_SESSION['secretKey']=$_POST['secretKey'];
	$_SESSION['redirectURI']=$_POST['redirectURI'];
	$_SESSION['username']=$_POST['username'];
	$_SESSION['count']=$_POST['count'];
	$_SESSION['imageType']=$_POST['imageType'];
	
	$clientID=$_SESSION['clientID'];
	$secretKey=$_SESSION['secretKey'];
	$redirectURI=$_SESSION['redirectURI'];
	$username=$_SESSION['username'];
	$count=$_SESSION['count'];
	$imageType=$_SESSION['imageType'];
	
	echo "Retrieving Instagram Access Token, please wait....";
	echo '<script>window.location = "https://api.instagram.com/oauth/authorize/?client_id='.$clientID.'&redirect_uri='.$redirectURI.'&response_type=code"</script>';
}
 if($_GET['code']) {

    $code = $_GET['code'];
    $url = "https://api.instagram.com/oauth/access_token";
    $access_token_parameters = array(
      'client_id'                =>     $_SESSION['clientID'],
      'client_secret'            =>     $_SESSION['secretKey'],
      'grant_type'               =>     'authorization_code',
      'redirect_uri'             =>     $_SESSION['redirectURI'],
      'code'                     =>     $code
    );
	
    $curl = curl_init($url);    // we init curl by passing the url
    curl_setopt($curl,CURLOPT_POST,true);   // to send a POST request
    curl_setopt($curl,CURLOPT_POSTFIELDS,$access_token_parameters);   // indicate the data to send
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   // to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   // to stop cURL from verifying the peer's certificate.
    $result = curl_exec($curl);   // to perform the curl session
    curl_close($curl);   // to close the curl session
    
     $arr = json_decode($result,true);
     $accessToken=$arr['access_token'];
//	 echo "token:<br>".$accessToken;


/***write that data!!!***/

$ourFileName = "parameters.php";
$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
fclose($ourFileHandle);

$file = 'parameters.php';

$current = 
'<?php
/**
** Parameters auto created from setup.php
** Feel free to modify these without running setup.php again
**/
	$clientID="'.$_SESSION['clientID'].'";
	$secretKey="'.$_SESSION['secretKey'].'";
	$redirectURI="'.$_SESSION['redirectURI'].'";
	$userName="'.$_SESSION['username'].'";
	$count="'.$_SESSION['count'].'";
	$imageType="'.$_SESSION['imageType'].'";
	$accesstoken="'.$accessToken.'";
?>';
			
// Write the contents back to the file
file_put_contents($file, $current);

/**************************/

// Destroy the session variables.
session_destroy();		
echo "<script>location.reload();</script";
	}

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="http://www.jchaike.com/instagram/style.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>
	<div id="step0" class="wizard" style="display:block;">
	<div id="content">
	<p>Welcome to the Simpstagram first time setup page!<br><br>
	The purpose of this script is to help you easily setup and obtain all required credentials to get your Instagram integrated in the simplest way<br>
	<br>
	Click "next" to continue.
	</div>
	<br><br>
	<input type="button" class="buttonback" id="disabled" disabled value="<<Back"/><input type="button" class="buttonnext" id="next0" value="Next>>"/>
	</div>
	
	<div id="step1" class="wizard">
	<div id="content">
	<h2>Step 1:</h2>
	Visit the <a target="_blank" href="http://www.instagram.com/developer">Instagram Developer Page</a><br>
	<br>
	<img src="http://www.jchaike.com/instagram/step1.gif"/>
	<br><br>
	(opens in new tab)
	</div>
	<br><input type="button" class="buttonback" id="back1" value="<<Back"/><input type="button" class="buttonnext" id="next1" value="Next>>"/>
	</div>
	
	<div id="step2" class="wizard" >
	<div id="content">
	<h2> Step 2:</h2>
	Log in, and click "Manage Clients"
	<br><br>
	<img src="http://www.jchaike.com/instagram/step2.gif"/>
	</div>
	<br><input type="button" class="buttonback" id="back2" value="<<Back"/><input type="button" class="buttonnext" id="next2" value="Next>>"/>
	</div>
	
	<div id="step3" class="wizard" >
	<div id="content">
	<h2>Step 3:</h2>
	Click "Register a New Client"
	<br>
	<img src="http://www.jchaike.com/instagram/step3.gif"/>
	</div>
	<br><input type="button" class="buttonback" id="back3" value="<<Back"/><input type="button" class="buttonnext" id="next3" value="Next>>"/>
	</div>
	
	<div id="step4" class="wizard" >
	<div id="content">
	<h2>Step 4:</h2>
	Create your application<br>
	<b>IMPORTANT:<br><br>THIS IS YOUR REDIRECT URI:</b><br><br><br>
	<?php 
	  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
	//  $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
	  $url .= $_SERVER["REQUEST_URI"];
	  print '<center><b>'.$url.'</b></center>'; 
	?>
	</div>
	<br><input type="button" class="buttonback" id="back4" value="<<Back"/><input type="button" class="buttonnext" id="next4" value="Next>>"/>
	</div>
	
	<div id="step5" class="wizard" >
	<div id="content">
	Fill out the information below:<br>

	<form method="post" action="setup.php" name="parametersform">
		Client ID: <input type="text" name="clientID" ><br>
		Secret Key: <input type="text" name="secretKey"><br>
		Redirect URI: <input type="text" name="redirectURI" value="<?php echo $url;?>"><br>
		Username: <input type="text" name="username"><br>
		Number of Photos (>33): <input type="text" name="count"><br>
		Image Type:
		<select name="imageType">
			<option>standard_resolution</option>
			<option>low_resolution</option>
			<option>thumbnail</option>
		</select>
		</div>
		<br>
		<input type="button" class="buttonback" id="back5" value="<<Back"/><input class="buttonnext" type="submit" name="send" value="Install>"/>
	</form>
	</div>
<div id="footer">
<div id="content">
Script created by:<br>
Josh Chaiken (jchaike)<br>
<a href="http://www.jchaike.com">site</a> | <a href="http://www.github.com/jchaike">git</a> | <a href="http://www.twitter.com/jchaike">tw</a>
<br>
<a href="mailto:josh@jchaike.com">email</a>
<br>
<div id="notes">
Clippy, and setup wizard are (C) Microsoft
Instagram is (C) Instagram Inc.
Script created by Josh Chaiken
</div>
</div>
</div>
</body>
<script src="http://www.jchaike.com/instagram/wizard.js"></script>
</html>