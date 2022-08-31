<?php 

session_start();

		//something was posted
		$username = $_POST['username'];
		$password = $_POST['password'];


		if(!empty($username) && !empty($password) )
		{
			$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbname = "registration";
	
	//$port = "3306";
	//create a connection
	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

			//read from database
			$query = "select * from register_data where username = '$username' limit 1";
			$result = mysqli_query($conn, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['userid'] = $userdata['userid'];
						header("Location: filter.html");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	

?>
