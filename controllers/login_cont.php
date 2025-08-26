<?php 
	#   Author of the script
	#   Name: Jeremiah Achanya
	#   Email: jeremiahachanya@gmail.com
	#   Date created: 26/8/2024 
	#   Date modified: 26/8/2024  
	include_once('models/User.php');

  	/*  $admin = new admin();
  	 //echo $admin->encryptMd5( '1234' );
   	//echo $admin->encryptHashHmac( $algo = 'sha512', $data = '12345', $key = '' );
   	echo $admin->encPword( '12345' );
   	exit; */

	//Creating instances
	$user = new User(); 

	if ( isset( $_POST[ 'btn_login' ] ) ) 
	{
		// Getting user values
		$uname = $_POST[ 'username' ];
		$pword = $_POST[ 'password' ]; 

		//Validating inputs
		if ( $uname && $pword ) 
		{
			$dt_01 = [ $uname, $uname ];
			$user_dt = $user->Login( $dt_01);
			$pwordx = $user_dt[ 'pword' ] ?? '';
			
			//Match user password
			$match_pword = $user->decPword( $pword, $pwordx );

			if ( $match_pword ) 
			{  
				$_SESSION['user_id'] = $user_dt['id'];
				$_SESSION['user_name'] = $user_dt['user_name'];
				$_SESSION['user_img'] = $user_dt['user_img'];
				
				$id = $_SESSION['user_id'];

				//set session and cookie
				$time_out = time() + APP_SESS_TIME;
				$_SESSION[ APP_SESS ] = $id;
				setcookie( APP_SESS, $id, $time_out );

				//redirect
				header( 'Location: ./dashboard', true, 301 );
				exit();
			} 
			else 
			{
				$msg = $web_app->showAlertMsg( 'danger', 'Sorry, user Does Not Exist!' ); 
			}

		}
		else 
		{  
			$msg = $web_app->showAlertMsg( 'info', 'Please, Enter Username And Password.' ); 	
		}
	}
	elseif (isset($_POST[ 'btn_register' ] ) ) 
	{
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$conf_password = $_POST['confirm_password'];

		if ($password == $conf_password) {

			if ($username  && $email && $password) {
				if ($user->getEmail([$email])) {
					$msg = $web_app->showAlertMsg( 'danger', 'Email Already Exist!' );
				}
				else{

					$count = $user->getCount([]);
	
					for ($i=0; $i < 5; $i++) { 
						$next_id = (int)$count + 1;
						$user_no = 'user-' . date('Y') .'-'. str_pad($next_id, max(4, strlen($next_id)), '0', STR_PAD_LEFT); // function
	
						if (!$user->getRefNo([$user_no])) {
							$passed = true;
							break;
						}
					}
					
					if ($passed) {
	
						$dt = [$user_no, $username, $email, $user->encPword($password)];
	
						if ($user->addnew($dt)) {
							$msg = $web_app->showAlertMsg( 'success', 'User Successfully Added!' );
						}
						else {
							$msg = $web_app->showAlertMsg( 'danger', 'Please Try Again!' );
						}

					}
				}
			}

			else {
				$msg = $web_app->showAlertMsg( 'danger', 'Fill in Required Fields!' );
			}
		}
		else {
			$msg = $web_app->showAlertMsg( 'danger', 'Use Matching Passwords!' ); 
		}

	} 


	//home interface
	include_once( 'views/login.php' );
?>