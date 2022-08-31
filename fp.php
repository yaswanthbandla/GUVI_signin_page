<?php 

session_start();

		//something was posted
		$email = $_POST['email'];
		$cd = $_POST['cd'];
		$fav = $_POST['fav'];
		$password = $_POST['password'];


		if(!empty($email) && !empty($password) )
		{
//echo "inside if";
	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbname = "registration";
	
	//$port = "3306";
	//create a connection
	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	$query1 = "select * from register_data where email = '$email' limit 1";
			$result1 = mysqli_query($conn, $query1);
			$user_data = mysqli_fetch_assoc($result1);
			//read from database
			if(isset($_POST['submit']) && $user_data['cd'] === $cd && $user_data['fav'] === $fav)
			{
				//$query = "UPDATE 'register_data' SET password='$_POST[password]' WHERE email='$_POST[email]";
				$query="UPDATE `register_data` SET `password`='".$password."' WHERE `email`='".$email."' ";
				$result=mysqli_query($conn,$query);
				if($result)
				{
					header("Location: login_page.html");
					echo "fefwwr";
				}
				else
				{
					echo "enter correct details";
				}
			//}
			mysqli_close($conn);
			}
			else
			{
			header("Location: foregt_pass.html");
			
			
			}
	}
		