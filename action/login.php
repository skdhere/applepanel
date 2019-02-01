<?php

include('../config/autoload.php');

class login extends Database {

	function check_login(){

		$where['mu_email'] =  $_POST['emailId'];
		$where['mu_password'] =  md5($_POST['pwfield']);

		$db          = new Database();
		$user_detail = $this->select('tbl_mgnt_users',$where);
		if($user_detail){

			$resp['success'] = true;
			$resp['message'] = "Login successfully!";
			$resp['request_url'] = "";

			$_SESSION['panel_user'] = array();		
			$_SESSION['sqyard_user'] = $user_detail;
			$_SESSION['userType'] = $user_detail['mu_mr_role_id'];
			$_SESSION['login_id'] = $user_detail['mu_id'];
			$_SESSION['mu_org_id'] = $user_detail['mu_org_id'];

			if(isset($_SESSION['request_url'])){
				$resp['request_url'] = $_SESSION['request_url'];
			}	

		}else{
			$resp['success'] = false;
			$resp['message'] = "Invalid email or password!";
		}

		echo json_encode($resp);

	}

	function forgot_password(){

	}
}




$request = $_GET['request'];
$login = new login();

switch ($request) {
	case 'authenticate':
		$login->check_login();
		break;
	
	default:
		# code...
		break;
}

?>