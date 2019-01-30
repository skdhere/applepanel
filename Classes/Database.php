<?php
	
	Class Database{
		
		protected $db_host = DB_HOST;
		protected $db_name = DB_NAME;
		protected $db_user = DB_USERNAME;
		protected $db_pass = DB_PASSWORD;
		protected $db_con  = false;
		
		public function __construct()
        {
            $this->db_con = mysqli_connect($this->db_host,$this->db_user, $this->db_pass) or die("Can not connect to Database"); 
            if($this->db_con)
			{
				mysqli_select_db($this->db_con,DB_NAME) or die(mysqli_error($this->db_con));
			}   
        }

        public function insert_record(){
        	echo 1;
        }

        

        public function query($sql){
        	$result = mysqli_query($this->db_con,$sql) or die(mysqli_error());
        	if(mysqli_num_rows($result)!=""){
        		return mysqli_fetch_array($result);
        	}

        	return NULL;
        }

        function insert($table, $variables = array() )
		{
					//Make sure the array isn't empty
			global $db_con;
			if( empty( $variables ) )
			{
				return false;
				exit;
			}
			
			$sql = "INSERT INTO ". $table;
			$fields = array();
			$values = array();
			foreach( $variables as $field => $value )
			{
				$fields[] = $field;
				$values[] = "'".$value."'";
			}
			$fields = ' (' . implode(', ', $fields) . ')';
			$values = '('. implode(', ', $values) .')';
			
			$sql .= $fields .' VALUES '. $values;

			$result		= mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
			
			if($result)
			{
				return mysqli_insert_id($db_con);
			}
			else
			{
				return false;
			}
		}

		function update($table, $variables = array(), $where,$not_where_array=array(),$and_like_array=array(),$or_like_array=array())
		{
			//Make sure the array isn't empty
			global $db_con;
			if( empty( $variables ) )
			{
				return false;
				exit;
			}
			
			$sql = "UPDATE ". $table .' SET ';
			$fields = array();
			$values = array();
			
			foreach($variables as $field => $value )
			{   
				$sql  .= $field ."='".$value."' ,";
			}
			$sql   =chop($sql,',');
			
			$sql .=" WHERE 1 = 1 ";
			//==Check Where Condtions=====//
			if(!empty($where))
			{
				foreach($where as $field1 => $value1 )
				{   
					$sql  .= " AND ".$field1 ."='".$value1."' ";
				}
			}

			$result 		= mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
			
			if($result)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		function select($table ,$where, $not_where_array=array(), $and_like_array=array(), $or_like_array=array())
		{
			
			if($table=="")
			{
				quit('Table name can not be blank');
			}
			$sql = " SELECT * FROM ". $table ;
			$fields = array();
			$values = array();
			
			
			$sql .=" WHERE 1 = 1 ";
			
			//==Check Where Condtions=====//
			if(!empty($where))
			{
				foreach($where as $field1 => $value1 )
				{   
					$sql  .= " AND ".$field1 ."='".$value1."' ";
				}
			}
			
			//==Check Not Where Condtions=====//
			if(!empty($not_where_array))
			{
				foreach($not_where_array as $field2 => $value2)
				{   
					$sql  .= " AND ".$field2 ."!='".$value2."' ";
				}
			}
			
			$result 		= mysqli_query($this->db_con,$sql) or die(mysqli_error($this->db_con));
			$num            = mysqli_num_rows($result);
			if($num > 0)
			{
				$row = mysqli_fetch_array($result);
				return $row;
			}
			else
			{
				return false;
			}
		}

	}
?>