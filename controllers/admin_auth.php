<?php 
 	#   Author of the script
	#   Name: Jeremiah Achanya
	#   Email: jeremiahachanya@gmail.com
	#   Date created: 26/8/2024 
	#   Date modified: 26/8/2024  

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