<?php 
	#   Author of the script
	#   Name: Ezra Adamu
	#   Email: ezra00100@gmail.com
	#   Date created: 26/12/2024 
	#   Date modified: 28/12/2024  
	include_once('models/User.php');

  	/*  $admin = new admin();
  	 //echo $admin->encryptMd5( '1234' );
   	//echo $admin->encryptHashHmac( $algo = 'sha512', $data = '12345', $key = '' );
   	echo $admin->encPword( '12345' );
   	exit; */

	//Creating instances
	$user = new User(); 

	if ( isset( $_POST[ 'btn_submit' ] ) ) 
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

	//home interface
	include_once( 'views/login.php' );
?>