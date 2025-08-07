<?php 
   #   Author of the script
   #   Name: Ezra Adamu
   #   Email: ezra00100@gmail.com
   #   Date created: 17/08/2022 
   #   Date modified: 02/07/2024  
   ob_start();
   
   if ( session_status() == PHP_SESSION_NONE )
   {
      session_start();    
   }       
   
   //App functions
   include_once( 'config.php' );
   include_once( 'models/WebApp.php' );
   include_once('models/User.php');

   $admin = new User();
  
   $web_app = new WebApp();

   //page name logic
   $uri_arr = explode( '/', $uri );
   $uri_len =  count( $uri_arr );
   $page_starts = $uri_len - 1;
   #$page = $uri_arr[ $page_starts ];

   $page_arr = explode( '?', $uri_arr[ $page_starts ] );
   $page = $page_arr[0];
   $page = $web_app->fixUrl( $page );

   //$server_name_1 = $server_name . '?tab=';

   //disable header
   $header_blacklist_arr = [ 'login' ];

   //setting sign up as default
   if ( !$page ) 
   {
      $page = 'login';
   }
   
   include_once( 'views/header.php' );

   $page_x = $page . '_cont.php';
   $file = "$cur_dir/controllers/$page_x";

   //checking and including file
   if ( is_file( $file ) )
   {
      include_once( $file );
   }
   else
   {
      header( "Location: $server_name", true, 301 );
      exit();
   }

   include_once( 'views/footer.php' );
   
   ob_end_flush();
?>