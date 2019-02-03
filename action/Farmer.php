<?php

include('../config/autoload.php');

class Farmer extends Database {

	function AddFarmer(){

		$data['fm_caid']              = $_SESSION['login_id'];
		$data['fm_org_id']            = $_POST['fm_org_id'];
		$data['fm_id']                = $this->getLastInsertId();
		$data['fm_name']              = $_POST['txt_name'];
		$data['fm_state']             = $_POST['fm_state'];
		$data['fm_district']          = $_POST['fm_district'];
		$data['fm_taluka']            = $_POST['fm_taluka'];
		$data['fm_village']           = $_POST['fm_village'];
		$data['education_status']     = $_POST['educational_status'];
		$data['fm_gender']            = $_POST['gender'];
		$data['fm_date_of_birth']     = $_POST['txt_dob'];
		$data['fm_age']               = $_POST['txt_age'];
		$data['fm_mobileno']          = $_POST['fm_mobileno'];
		$data['fm_landline']          = $_POST['alt_mobileno'];
		$data['fm_email']             = $_POST['fm_email'];
		$data['fm_residing_area']     = $_POST['fm_residing_area'];
		$data['personal_experience']  = $_POST['personal_experience'];
		$data['no_of_family_members'] = $_POST['no_of_family_members'];
		$data['fm_marital_status']    = $_POST['ddl_married_status'];
		$data['fm_createddt']         = date('Y-m-d h:i:s');
		$data['fm_createdby']           = $_SESSION['login_id'];
		$this->insert('tbl_farmers',$data);

		$response['Success'] = true;
		$response['resp']   = 'Farmer added successfully!';
        echo json_encode($response);
	}

	function updateFarmer(){

		$fm_id = $_POST['fm_id'];

		$data['fm_caid']              = $_SESSION['login_id'];
		$data['fm_org_id']            = $_POST['fm_org_id'];
		$data['fm_name']              = $_POST['txt_name'];
		$data['fm_state']             = $_POST['fm_state'];
		$data['fm_district']          = $_POST['fm_district'];
		$data['fm_taluka']            = $_POST['fm_taluka'];
		$data['fm_village']           = $_POST['fm_village'];
		$data['education_status']     = $_POST['educational_status'];
		$data['fm_gender']            = $_POST['gender'];
		$data['fm_date_of_birth']     = $_POST['txt_dob'];
		$data['fm_age']               = $_POST['txt_age'];
		$data['fm_mobileno']          = $_POST['fm_mobileno'];
		$data['fm_landline']          = $_POST['alt_mobileno'];
		$data['fm_email']             = $_POST['fm_email'];
		$data['fm_residing_area']     = $_POST['fm_residing_area'];
		$data['personal_experience']  = $_POST['personal_experience'];
		$data['no_of_family_members'] = $_POST['no_of_family_members'];
		$data['fm_marital_status']    = $_POST['ddl_married_status'];
		$data['fm_modifieddt']        = date('Y-m-d h:i:s');
		$data['fm_modifiedby']        = $_SESSION['login_id'];
		$this->update('tbl_farmers',$data,['fm_id'=>$fm_id]);

		$response['Success'] = true;
		$response['resp']    = 'Farmer updated successfully!';
        echo json_encode($response);
	}

	function getLastInsertId(){

		$sql =" SELECT 	fm_id FROM tbl_farmers ORDER BY fm_id desc LIMIT 1";
		$result = $this->query($sql);
		if($result){
			$row = mysqli_fetch_array($result);
			return $row['fm_id']+1;
		}

		return 100000;
	}

	
}

$request = $_GET['request'];
$farmer = new Farmer();

switch ($request) {
	case 'add':
		$farmer->AddFarmer();
		break;
	
	case 'edit':
		$farmer->updateFarmer();
		break;
	

	default:
		# code...
		break;
}

?>