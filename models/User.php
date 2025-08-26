<?php
	#   Author of the script
	#   Name: Jeremiah Achanya
	#   Email: jeremiahachanya@gmail.com
	#   Date created: 26/8/2024 
	#   Date modified: 26/8/2024 

	include_once( 'Db.php' );
	include_once( 'Encryption.php' );
	include_once( 'File.php' );

	class User
	{
		//using Namespaces
		use Db {
      		Db::__construct as private __appConst;
    	}

		use File;

		use Encryption;

		protected $table = '';

		function __construct()
	 	{
	 		$this->__appConst();
	 		$this->table = DB_TABLE_USER;
	 	}

		function login( array $dt ) 
		{
			$sql = "SELECT * FROM $this->table WHERE ( user_name = ? OR email = ? )";
			$res = $this->fetchSingle( $sql, $dt );

			return $res ?? [];
		}
		
		function getByTokenLogin( array $dt ) 
		{
			$sql = "SELECT * FROM $this->table WHERE token_login = ?";
			$res = $this->fetchSingle( $sql, $dt );
			
			return $res ?? [];
		}

      function updateTokenLoginById( array $dt ) 
		{	
			$sql = "UPDATE $this->table SET token_login = ? WHERE id = ?";
			$res = $this->runQuery2( $sql, $dt );
			
			return $res ?? false;
		}

		function getLoggedAdmin()
		{
			return $_COOKIE[ APP_SESS ] ?? 0;
		}

		function getById( array $dt ) 
		{
			$sql = "SELECT * FROM $this->table WHERE id = ?";
			$res = $this->fetchSingle( $sql, $dt );

			return $res ?? [];
		}

		function updateImg(array $dt) {
			$sql = "UPDATE $this->table SET `user_img`= ? WHERE `user_no`= ? ";
			$res = $this->runQuery2($sql, $dt);
			return $res ?? false;
		}

		function getCount( array $dt ) 
		{
			$sql = "SELECT COUNT(id) AS total FROM $this->table";
			$res = $this->fetchSingle( $sql, $dt );

			return $res['total'] ?? 0;
		}

		function getRefNo(array $dt) {
			$sql = "SELECT id FROM $this->table WHERE user_no = ?";
			$res = $this->runQuery2($sql, $dt);
			return $res ?? false;
		}

		function addnew( array $dt ) 
		{
			$sql = "INSERT INTO $this->table (`user_no`, `user_name`, `email`, `pword` ) VALUES (?, ?, ?, ?)";
			$res = $this->runQuery( $sql, $dt );

			return $res ?? false;
		}

		function getEmail(array $dt) {
			$sql = "SELECT email FROM $this->table WHERE email = ? ";
			$res = $this->runQuery2($sql, $dt);
			return $res ?? false;
		}

	}
?>