<?php 
	#   Author of the script
	#   Name: Jeremiah Achanya
	#   Email: jeremiahachanya@gmail.com
	#   Date created: 26/8/2024 
	#   Date modified: 26/8/2024 

	trait Db
	{
		private $con;

		// Initializing Database
		function __construct()
		{
			$this->con = $this->connect();
		}

		// Initializing Database
		public function connect()
		{
			try
			{
				$this->con = new PDO( 'mysql:host=' . HOST . ';dbname=' . DB , USER, PWORD );
				$this->con->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
				$this->con->setAttribute( PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true ); 
				$this->con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				
				
				//echo 'connected';
				return $this->con;
			} 
			catch ( PDOException $e )
			{
				//echo 'There was an error! unable to connect to DB<br/>';// . $e->getMessage();
				return false;
			}	 
		}
		
		function runQuery( $sql, $data = [] )
		{
			$query = $this->con->prepare( $sql );
			$row = $query->execute( $data );

			return $row ? true : false;
		}

		function runQuery2( $sql, $data = [] )
		{
			$res = false;
			$query = $this->con->prepare( $sql );
			$query->execute( $data );
			
	    	// checking result 
			if ( $query->rowCount() > 0 ) 
			{
				$res = true;
			}

			return $res;
		}

		function fetchSingle( $sql, $data = [] )
		{
			$query = $this->con->prepare( $sql );
			$query->execute( $data );

			return $query->fetch( PDO::FETCH_ASSOC );
		}

		function fetchMultiple( $sql, $data = [] )
		{ 
			$query = $this->con->prepare( $sql );
			$query->execute( $data );
			$dt = [];

	    	// looping through records
			while ( $row = $query->fetch( PDO::FETCH_ASSOC ) )
			{
				array_push( $dt, $row );
			}

			return $dt;
		}

	}
?>