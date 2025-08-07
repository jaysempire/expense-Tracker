<?php 
 	#   Author of the script
	#   Name: Ezra Adamu
	#   Email: ezra00100@gmail.com
	#   Date created: 17/08/2022 
	#   Date modified: 12/05/2023  

	include_once( 'models/User.php' );

	//Creating instances
	$user = new User();  
	$user_id = $user->getLoggedAdmin();

	//when not logged in
	if ( !$user_id ) 
	{
		header( "Location: ./", true, 301 );
		exit();
	}

?>