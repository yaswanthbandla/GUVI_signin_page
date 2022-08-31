<?php
session_start();
$Name = $_POST['Name'];
$username = $_POST['username'];
$userid = $_POST['userid'];
$password = $_POST['password'];
$gender= $_POST['gender'];
$email = $_POST['email'];
$phonecode = $_POST['phonecode'];
$phone = $_POST['phone'];
$cd = $_POST['cd'];
$fav = $_POST['fav'];

if(!empty($Name)|| !empty($username)|| !empty($userid)|| !empty($password)|| !empty($gender)|| !empty($email) || !empty($phonecode)|| !empty($phone) 
	|| !empty($cd)|| !empty($fav)){
	//echo "inside if";
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbname = "registration";
	
	//$port = "3306";
	//create a connection
	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);


	if(mysqli_connect_error()){
		die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
	}
	else{
		$SELECT = "SELECT email From register_data Where email = ? Limit 1";
		$userid = random_num(20);
		$INSERT = "INSERT Into register_data (Name,username,userid,password ,gender, email,phonecode,phone,cd,fav) values( ?, ?, 
		?,?, ?, ?, ?, ?,?,?)";
		//prepare a statement
		$stmt = $conn->prepare($SELECT);
		$stmt->bind_param("s",$email);
		$stmt->execute();
		$stmt->bind_result($email);
		$stmt->store_result();
		$rnum = $stmt->num_rows;
		
		if($rnum==0){
			$stmt->close();
			
			$stmt = $conn->prepare($INSERT);
			$stmt->bind_param("ssisssssss", $Name, $username,$userid, $password, $gender, $email, $phonecode, $phone, $cd, $fav);
			$stmt->execute();
			echo "New Record Inserted Successfully";
			header("Location: login_page.html");
			//<form action="choicemain.html" method="POST">
			}
		else{
			echo "already registered  ";
			 
		}
		$stmt->close();
		$conn->close();
	}
}
else{
	echo "All field are Required";
	die();
}
function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}
?>