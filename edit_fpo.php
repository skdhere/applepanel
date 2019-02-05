<?php
	include('config/autoload.php');

    $adminusers_id         = (isset($_REQUEST['fpo_id'])?$_REQUEST['fpo_id']:"");

    $sql_users_info = "select * from tbl_mgnt_users where mu_id = '$adminusers_id'";
    $res_users_info = mysqli_query($db_con, $sql_users_info) or die(mysqli_error($db_con));
    $num_users_info    = mysqli_num_rows($res_users_info);
        if($num_users_info != 0)
        {
            $row_users_info    = mysqli_fetch_array($res_users_info);
        }


	$feature_name 	= 'FPO';
	$home_name    	= "Home";
	$title			= 'Edit FPO';
	$home_url 	  	= "home.php";
	$filename		= 'view_fpo.php';
	
	if($adminusers_id == "" && !isset($_SESSION['sqyard_user']) && $_SESSION['sqyard_user']=="")
	{
		?>
		<script type="text/javascript">
        history.go(-1);
        </script>
        <?php	
	}
?>

<!doctype html>
<html>
    <head>
        <?php
        /* This function used to call all header data like css files and links */
        headerdata($feature_name);
        /* This function used to call all header data like css files and links */
        ?>

       
    </head>
    
    <body class="<?php echo THEME_NAME ?>" data-theme="<?php echo THEME_NAME ?>">
        <?php
        /*include Bootstrap model pop up for error display*/
        modelPopUp();
        /*include Bootstrap model pop up for error display*/
        /* this function used to add navigation menu to the page*/
        navigation_menu();
        /* this function used to add navigation menu to the page*/
        ?> <!-- Navigation Bar -->
       
       <!-- Page Content -->
       <section class="page-content">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="box box-color box-bordered green">
                            <div class="box-title">
                                <h3>
                                    <i class="icon-table"></i>
                                    Edit FPO
                                </h3>
                            </div>
                            <div class="box-content nopadding">
                            <form method="POST" enctype="multipart/form-data" class='form-horizontal form-bordered form-validate' id="edit_fpo_users" name="edit_fpo_users">
                                
                                <input type="hidden" id="hid_user_edit" name="hid_user_edit" value="1">
                                <input type="hidden" id="hid_user_id" name="hid_user_id" value="<?php echo $adminusers_id; ?>">
                                <input type="hidden" id="hid_org_id" name="hid_org_id" value="<?php echo $row_users_info['mu_org_id']; ?>">
                                <input type="hidden" name="txt_userType" id="txt_userType" value="FPO">

                                <div class="control-group">
                                    <label for="text" class="control-label" style="margin-top:10px">
                                        Name <span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="txt_name" name="txt_name" class="input-xlarge v_name" value="<?php if((isset($row_users_info['mu_name'])) && $row_users_info['mu_name'] != '') { echo $row_users_info['mu_name']; } ?>" data-rule-required="true" placeholder="Enter Your Name">
                                    </div>
                                </div>  <!-- Name -->
                                
                                <div class="control-group">
                                    <label for="text" class="control-label" style="margin-top:10px">
                                        Email/Username <span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="txt_email" name="txt_email" class="input-xlarge" data-rule-required="true" value="<?php if((isset($row_users_info['mu_email'])) && $row_users_info['mu_email'] != '') { echo $row_users_info['mu_email']; } ?>" data-rule-email="true" placeholder="Enter Your Email Address">
                                    </div>
                                </div>  <!-- Email / Username -->
                                
                                <div class="control-group">
                                    <label for="numberfield" class="control-label">
                                        Mobile No. <span style="color:#F00">*</span>
                                    </label>
                                
                                    <div class="controls">
                                        <input type="text" placeholder="Mobile no" name="txt_mobileno" id="txt_mobileno" maxlength="10"  autocomplete="off" data-rule-required="true" data-rule-minlength="10"  data-rule-maxlength="10" value="<?php if((isset($row_users_info['mu_mobile'])) && $row_users_info['mu_mobile'] != '') { echo $row_users_info['mu_mobile']; } ?>" class="input-xlarge v_number">
                                        <label id="comp_2" style="color:#FF0000;width:200px;margin-left:100px;"></label>    
                                    </div>
                                </div> <!-- Mobile No -->

                                <div class="control-group">
                                    <label for="text" class="control-label" style="margin-top:10px">
                                        Password <span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="txt_password" name="txt_password" class="input-xlarge" value="<?php if((isset($row_users_info['password'])) && $row_users_info['password'] != '') { echo $row_users_info['password']; } ?>"  placeholder="Enter Your Password" >
                                    </div>
                                </div>  <!-- Password -->
                                
                                <div class="form-actions" style="clear:both;">
                                    <button id="submit" name="Submit" type="submit" class="btn btn-primary" >Submit</button>
                                    <button id="reset" type="button" class="btn" onclick="window.history.back()">Cancel</button>
                                </div> <!-- Submit -->
                            
                            </form> 
                        </div>
                            
                       </div>
                   </div>
               </div>
            </div>      
        </section>
            <!-- Page Content / End -->
        <script type="text/javascript">

            var baseurll            = '<?php echo BASE_FOLDER; ?>';

            $('#edit_fpo_users').on('submit', function(e) 
            {
                e.preventDefault();
                if ($('#edit_fpo_users').valid())
                {
                    
                    $.ajax({
                        url: "load_fpo.php?",
                        type: "POST",
                        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false,       // The content type used when sending data to the server.
                        cache: false,             // To unable request pages to be cached
                        processData:false,        // To send DOMDocument or non processed data file it is set to false
                        async:true,                     
                            success: function(response) 
                            {   data = JSON.parse(response);
                                if(data.Success == "Success") 
                                {  
                                    location.href   = baseurll + "/view_fpo.php?pag=fpo";
                                } 
                                else 
                                {   
                                    alert(data.resp);
                                   
                                }
                            },
                            error: function (request, status, error) 
                            {
                                $("#model_body").html('<span style="style="color:#F00;">'+request.responseText+'</span>');                          
                                $('#error_model').modal('toggle');  
                                loading_hide();
                            },
                            complete: function()
                            {
                                //alert("complete");
                                loading_hide();
                            }
                        });
                }
            });
        </script>


    </body>
</html>