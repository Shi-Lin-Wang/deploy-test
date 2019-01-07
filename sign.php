<?php


include 'JWToken.php';

/* With algo -	RSA (Public Key/Private Key pair) */


	include "DB_info.php";

	$dbname = 'wsse';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass) ;//連接資料庫
	//echo 'connect correct';
	mysqli_query($conn,"SET NAMES utf8");
	mysqli_select_db($conn,$dbname);
	header('Content-Type: application/json;charset=utf-8');
	
	

	$acc = $_POST['Account'];
	$pwd = $_POST['Password']; //must post

	if(checkAccount($acc,$pwd,$conn)){
		packageToken($acc);
		setcookie("failToLogin",null,time()-360000,"/","140.127.74.191",0,0);
		echo $_COOKIE['token'];
		header("Location:http://140.127.74.191/bootstrap-WSSE/index.html");
	}else{
		$failToLogin = $_COOKIE["failToLogin"];
		$failToLogin += 1;
		setcookie("failToLogin",$failToLogin,time()+(300),"/","140.127.74.191",0,0);
		header("Location:http://140.127.74.191/bootstrap-WSSE/login.html");
		
		
	}
	

	function checkAccount($acc,$ps,$conn){
		$return_arr = array();

		//$location_sql = "SELECT `Latitude`, `Longitude` FROM `box` WHERE `UserAccount` = '$acc'";
		$sql = "SELECT * FROM `user` Where Account = '$acc' AND Password = '$ps'";
		//$location_result = mysqli_query($conn, $location_sql);
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result);
		if($row['Account']==$acc && $row['Password'] ==$ps ){
			//echo "hello";
			return true;
		}else{
			echo "useless";
			return false;
		}
	
	}

	function packageToken($acc){
		$Time = date('Y-m-d H:i:s',time()+21600);
		$payload = array(
			'UserName' => "$acc",
			'Time' => "$Time"
		);
		$private_key = file_get_contents('keys/private_key.pem');
		$token = JWToken::encode($payload, $private_key,'RS256');
		setcookie("token",$token,time()+(3600),"/","140.127.74.191",0,0);
		echo $token;
	}
	

	?>