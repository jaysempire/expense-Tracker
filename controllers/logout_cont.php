<?php 
	#   Author of the script
	#   Name: Ezra Adamu
	#   Email: ezra00100@gmail.com
	#   Date created: 26/12/2024 
	#   Date modified: 28/12/2024  
	$web_app->logout();
	header( 'Location: ./login', true, 301 );
	exit();

?>