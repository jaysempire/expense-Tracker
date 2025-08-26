<?php 
	#   Author of the script
	#   Name: Jeremiah Achanya
	#   Email: jeremiahachanya@gmail.com
	#   Date created: 26/8/2024 
	#   Date modified: 26/8/2024 
	$web_app->logout();
	header( 'Location: ./login', true, 301 );
	exit();

?>