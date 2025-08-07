<?php 
	#   Author of the script
   #   Name: Ezra Adamu
   #   Email: ezra00100@gmail.com
   #   Date created: 17/08/2022 
   #   Date modified: 12/08/2024  

	const ENVIRONMENT = 'Test';//Test Live

	//DB Config
   const HOST = 'localhost';
   const USER = 'root';
   const PWORD = '';
   const DB = 'expense_tracker';

   const DB_TABLE_USER = 'users';
   const DB_TABLE_TRANSAC = 'transactions';
   
	$msg = '';
	$clear = false;
	$website_title ='Duza';

	const APP_SESS = 'manager_admin_id';
	const APP_SESS_TIME = 3500;

	//url
   $server_name = ENVIRONMENT == 'Test' ? 'http://' : 'https://';
   $server_name .= 'localhost/2025/mini-php-mvc';//$_SERVER['SERVER_NAME'];
   $uri = $_SERVER['REQUEST_URI'];
   $app_url = ( strlen( $uri ) > 1 ) ? "$server_name$uri" : "$server_name";

   //directory
   $root_dir = dirname( __DIR__ );
   $cur_dir = dirname( __FILE__ );
   //echo getcwd();
   
   $upload_dir = "$cur_dir/uploads";
   $upload_url = "$server_name/uploads";
   $email_supp = [ 'abc@gmail.com' ];

   $id_addr = $_SERVER[ 'REMOTE_ADDR' ];
   
	$js_modules = [];
?> 