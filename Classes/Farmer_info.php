<?php

	Class Farmer_info extends database{
		
		private $farmer_id ='';
		private $table_name = "tbl_farmer";
		public function __construct()
        {
             parent::__construct();
        }

        function setFarmerId($id){
        	$this->farmer_id  = $id;
        }

        public function getFarmerInfo(){
        	
        	$sql =" SELECT * FROM ".$this->table_name." WHERE id='".$this->farmer_id."'";
        	$result =  mysqli_query($this->db_con,$sql);
        	return mysqli_fetch_array($result);
        }




	}
?>