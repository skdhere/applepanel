<?php

	Class Location extends Database{
		

		function get_states(){
            $db          = new Database();
        	$resp = [];
        	$sql = 'SELECT * FROM `tbl_state` ';


        	$result = $db->query($sql);
        	
        	if(mysqli_num_rows($result)!=0){
        		
        		while($row = mysqli_fetch_array($result)){
        			$resp[] = $row;
        		}

        		return $resp;
        	}

        	return $resp;
        }

        function getDistrict($state){
            
            $resp = [];
            $sql = "SELECT * FROM `tbl_district` WHERE dt_stid='".$state."'";

            $result = $this->query($sql);
            
            if(mysqli_num_rows($result)!=0){
                
                while($row = mysqli_fetch_array($result)){
                    $resp[] = $row;
                }

                return $resp;
            }

            return $resp;
        }

         function getTaluka($dist){
            
            $resp = [];
            $sql = "SELECT * FROM `tbl_taluka` WHERE tk_dtid='".$dist."'";

            $result = $this->query($sql);
            
            if(mysqli_num_rows($result)!=0){
                
                while($row = mysqli_fetch_array($result)){
                    $resp[] = $row;
                }

                return $resp;
            }

            return $resp;
        }

         function getVillage($taluka){
            
            $resp = [];
            $sql = "SELECT * FROM `tbl_village` WHERE vl_tkid='".$taluka."'";

            $result = $this->query($sql);
            
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