<?php
	
	Class Location extends Database{
		
		
		

        function get_states(){

        	$resp = [];
        	$sql = 'SELECT * FROM `tbl_state` ';
        	$result = mysqli_query($this->db_con,$sql) or die($this->db_con);
        	
        	if(mysqli_num_rows($result)!=0){
        		
        		while($row = mysqli_fetch_array($result)){
        			$resp[] = $row;
        		}

        		return $resp;
        	}

        	return $resp;
        }
        
	}
?>