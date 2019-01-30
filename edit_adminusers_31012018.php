<?php
	include('access1.php');
	include('include/connection.php');

    $adminusers_id         = (isset($_REQUEST['admin_id'])?$_REQUEST['admin_id']:"");

    $sql_users_info = "select * from tbl_change_agents where id = '$adminusers_id'";
    $res_users_info = mysqli_query($db_con, $sql_users_info) or die(mysqli_error($db_con));
    $num_users_info    = mysqli_num_rows($res_users_info);
        if($num_users_info != 0)
        {
            $row_users_info    = mysqli_fetch_array($res_users_info);
        }


	$feature_name 	= 'Users';
	$home_name    	= "Home";
	$title			= 'Edit Users';
	$home_url 	  	= "home.php";
	$filename		= 'view_adminusers.php';
	
	if($adminusers_id == "" && !isset($_SESSION['sqyard_user']) && $_SESSION['sqyard_user']=="")
	{
		?>
		<script type="text/javascript">
        history.go(-1);
        </script>
        <?php	
	}
	
	if($_SESSION['userType']=="Admin")
    {
        $sql = "SELECT * FROM `tbl_change_agents` ";
        $res = mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
        $r   = 1;
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
    
    <body class="<?php echo $theme_name; ?>" data-theme="<?php echo $theme_name; ?>">
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
                                    Edit User
                                </h3>
                            </div>
                            <div class="box-content nopadding">
                            <form method="POST" enctype="multipart/form-data" class='form-horizontal form-bordered form-validate' id="edit_adminusers" name="edit_adminusers">
                                
                                <input type="hidden" id="hid_user_edit" name="hid_user_edit" value="1">
                                 <input type="hidden" id="hid_user_id" name="hid_user_id" value="<?php echo $adminusers_id; ?>">
                                 <div class="control-group">
                                    <label for="tasktitel" class="control-label">UserType <span style="color:#F00">*</span></label>
                                    <div class="controls">
                                        <select id="txt_userType" name="txt_userType" class="select2-me input-xlarge" >
                                            <option value="" disabled selected>Select here</option>
                                            <option <?php if($row_users_info['userType'] == 'changeagent'){ ?> selected <?php } ?> value="changeagent">Change Agent</option>
                                            <option <?php if($row_users_info['userType'] == 'Admin'){ ?> selected <?php } ?> value="Admin">Admin</option>
                                        </select>
                                    </div>
                                </div>  
                                
                                <div class="control-group">
                                    <label for="text" class="control-label" style="margin-top:10px">
                                        Name <span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="txt_name" name="txt_name" class="input-xlarge v_name" value="<?php if((isset($row_users_info['fname'])) && $row_users_info['fname'] != '') { echo $row_users_info['fname']; } ?>" data-rule-required="true" placeholder="Enter Your Name">
                                    </div>
                                </div>  <!-- Name -->
                                
                                <div class="control-group">
                                    <label for="text" class="control-label" style="margin-top:10px">
                                        Email/Username <span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="txt_email" name="txt_email" class="input-xlarge" data-rule-required="true" value="<?php if((isset($row_users_info['emailId'])) && $row_users_info['emailId'] != '') { echo $row_users_info['emailId']; } ?>" data-rule-email="true" placeholder="Enter Your Email Address">
                                    </div>
                                </div>  <!-- Email / Username -->
                                
                                <div class="control-group">
                                    <label for="text" class="control-label" style="margin-top:10px">
                                        Password <span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="txt_password" name="txt_password" class="input-xlarge" value="<?php if((isset($row_users_info['password'])) && $row_users_info['password'] != '') { echo $row_users_info['password']; } ?>" data-rule-required="true" placeholder="Enter Your Password" >
                                    </div>
                                </div>  <!-- Mother's Name -->
                                
                                <div class="control-group">
                                    <label for="numberfield" class="control-label">
                                        Mobile No. <span style="color:#F00">*</span>
                                    </label>
                                
                                    <div class="controls">
                                        <input type="text" placeholder="Mobile no" name="txt_mobileno" id="txt_mobileno" maxlength="10"  autocomplete="off" data-rule-required="true" data-rule-minlength="10"  data-rule-maxlength="10" value="<?php if((isset($row_users_info['contactno'])) && $row_users_info['contactno'] != '') { echo $row_users_info['contactno']; } ?>" class="input-xlarge v_number">
                                        <label id="comp_2" style="color:#FF0000;width:200px;margin-left:100px;"></label>    
                                    </div>
                                </div> <!-- Mobile No -->
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

            var baseurll            = '<?php echo $BaseFolder; ?>';

            $('#edit_adminusers').on('submit', function(e) 
            {
                e.preventDefault();
                if ($('#edit_adminusers').valid())
                {
                    
                    $.ajax({
                        url: "load_adminusers.php?",
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
                                    location.href   = baseurll + "/view_adminusers.php?pag=adminusers";
                                } 
                                else 
                                {   
                                    alert(data.resp);
                                    location.href   = baseurll + "/error-404";
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

    <?php
    }
    else
    {
      ?>
        <script type="text/javascript">
        alert("You dont have right to access this page!");    
        history.go(-1);
        </script>
        <?php
    }

?>	

