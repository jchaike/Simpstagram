<!--
First time setup script Instructions are in the page. ;)
-->
<?php
session_start();
echo "So if you haven't noticed, there's lots of warnings. Probably should hide them.";
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


/***write that data as parameters!!!!***/

$ourFileName = "parameters.php";
$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
fclose($ourFileHandle);

$file = 'parameters.php';

// Append a new person to the file
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
	$count='.$_SESSION['count'].';
	$imageType="'.$_SESSION['imageType'].'";
	$accesstoken="'.$accessToken.'";
?>';
			
// Write the contents back to the file
file_put_contents($file, $current);

/********/

// Destroy the session variables.
session_destroy();		
echo "<script>location.reload();</script";
	}

?>

<html>
<head>
</head>
<body>

	<p>Welcome to the Simpstagram first time setup page!<br><br>
	The purpose of this script is to help you easily setup and obtain all required credentials to get your Instagram integrated in the simplest way<br>
	<br>
	This page assumes that you have registered an Instagram client through the Instagram developer page.
	<br>
	If not, you may do so by <a href="#">clicking here</a>.<br>
	<br>
	<b>IMPORTANT:</b><br>
	<i>Set your Redirect URI on the Instagram Client to the following URL <b>exactly</b> as shown below:<br></i><br>
	<?php 
	  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
	//  $url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
	  $url .= $_SERVER["REQUEST_URI"];
	  print $url; 
	?>
	<br><br>
	Please fill out the form below to get started:<br>

	<form method="post" action="setup.php" name="parametersform">
		Client ID: <input type="text" name="clientID" value="39318d8c7d3f430fb27ba26da18fdb38"><br>
		Secret Key: <input type="text" name="secretKey" value="f6d42df02c174181a15780d772b2ae8d"><br>
		Redirect URI: <input type="text" name="redirectURI" value="<?php echo $url;?>"><br>
		Username: <input type="text" name="username"><br>
		Number of Photos to Get (less than 33): <input type="text" name="count"><br>
		Image Type:
		<select name="imageType">
			<option>standard_resolution</option>
			<option>low_resolution</option>
			<option>thumbnail</option>
		</select>
		<br>
		<input type="submit" name="send" value="Next"/>
	</form>

</body>
</html>