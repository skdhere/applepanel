<?php
    require($_SERVER['DOCUMENT_ROOT'].'/applepanel/config/constant.php');
    require($_SERVER['DOCUMENT_ROOT'].'/applepanel/classes/database.php');
    require($_SERVER['DOCUMENT_ROOT'].'/applepanel/helper/helper_functions.php');

	Class Area extends Database{
		

		function get_states(){
            $db          = new Database();
        	$resp = [];
        	$sql = 'SELECT * FROM `tbl_state` ';


        	$result = $this->query($sql);
        	
        	if(mysqli_num_rows($result)!=0){
        		
        		while($row = mysqli_fetch_array($result)){
        			$resp[] = $row;
        		}

        		return $resp;
        	}

        	return $resp;
        }

        function getDistrict(){
            $state = $_POST['state'];
            $resp = [];
            $sql = "SELECT * FROM `tbl_district` WHERE dt_stid='".$state."'";

            $result = $this->query($sql);
            $html = '<option value="">Select District</option>';
            if(mysqli_num_rows($result)!=0){
                
                while($row = mysqli_fetch_array($result)){
                    $html .='<option value="'.$row['id'].'">'.ucfirst($row['dt_name']).'</option>';
                }
            }

            if(!empty($resp)){
                $response['sucess'] = true;
                $response['resp'] = $html;
                echo json_encode($response);
            }
            else{
                $response['sucess'] = false;
                $response['resp'] = $html;
                echo json_encode($response);
            }
        }

         function getTaluka(){
            $dist = $_POST['district'];
            $resp = [];
            $sql = "SELECT * FROM `tbl_taluka` WHERE tk_dtid='".$dist."'";

            $result = $this->query($sql);
            $html = '<option value="">Select Taluka</option>';
            if(mysqli_num_rows($result)!=0){
                
                while($row = mysqli_fetch_array($result)){
                    $html .='<option value="'.$row['id'].'">'.ucfirst($row['tk_name']).'</option>';
                }
            }

            if(!empty($resp)){
                $response['sucess'] = true;
                $response['resp'] = $html;
                echo json_encode($response);
            }
            else{
                $response['sucess'] = false;
                $response['resp'] = $html;
                echo json_encode($response);
            }
        }

         function getVillage(){
            $taluka = $_POST['taluka'];
            $resp = [];
            $sql = "SELECT * FROM `tbl_village` WHERE vl_tkid='".$taluka."'";

            $result = $this->query($sql);
            $html = '<option value="">Select Village</option>';
            if(mysqli_num_rows($result)!=0){
                
                while($row = mysqli_fetch_array($result)){
                    $html .='<option value="'.$row['id'].'">'.ucfirst($row['vl_name']).'</option>';
                }
            }

            if(!empty($resp)){
                $response['sucess'] = true;
                $response['resp'] = $html;
                echo json_encode($response);
            }
            else{
                $response['sucess'] = false;
                $response['resp'] = $html;
                echo json_encode($response);
            }
        }
    }

    if(isset($_POST['request']))
    {
        $request = $_POST['request'];
        $location = new Area();

        switch ($request) {
            case 'district':
                $location->getDistrict();
                break;
            case 'taluka':
                $location->getTaluka();
                break;
            case 'village':
                $location->getVillage();
                break;
            default:
                $location->get_states();
                break;
        }
    }
?>