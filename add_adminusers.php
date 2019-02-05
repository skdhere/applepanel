<?php
	include('config/autoload.php');
    
	$feature_name 	= 'Users';
	$home_name    	= "Home";
	$title			= 'View Users';
	$home_url 	  	= "home.php";
	$filename		= 'view_adminusers.php';
	
	if(!isset($_SESSION['sqyard_user']) && $_SESSION['sqyard_user']=="")
	{
		?>
		<script type="text/javascript">
        history.go(-1);
        </script>
        <?php	
	}
	
	if($_SESSION['userType']=="1")
    {
        $sql = "SELECT * FROM `tbl_mgnt_users` ";
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
    
    <body class="<?php echo THEME_NAME; ?>" data-theme="<?php echo THEME_NAME; ?>">
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
                                    Add User
                                </h3>
                            </div>
                            <div class="box-content nopadding">
                            <form method="POST" enctype="multipart/form-data" class='form-horizontal form-bordered form-validate' id="add_adminusers" name="add_adminusers">
                                
                                <input type="hidden" id="hid_user_reg" name="hid_user_reg" value="1">

                                <div class="control-group">
                                    <label for="tasktitel" class="control-label">Select Organization <span style="color:#F00">*</span></label>
                                    <div class="controls">
                                        <select id="org_id" name="org_id" class="select2-me input-xlarge" >
                                            <?php
                                            // Query For getting the org List
                                            $res_get_org_list = getRecord('tbl_organization', array('status'=>'1'));
                                            // echo $res_get_org_list;
                                            if($res_get_org_list)
                                            {
                                                $num_get_org_list = mysqli_num_rows($res_get_org_list);
                                                if($num_get_org_list != 0)
                                                {
                                                    ?>
                                                    <option value="" disabled selected>Select here</option>
                                                    <?php
                                                    while($row_get_org_list = mysqli_fetch_array($res_get_org_list))
                                                    {
                                                        ?>
                                                        <option value="<?php echo $row_get_org_list['id']; ?>">
                                                            <?php echo ucwords(strtolower($row_get_org_list['org_name'])) ?>
                                                        </option>
                                                        <?php
                                                    }
                                                }
                                                else
                                                {
                                                    ?>
                                                    <option value="">No Match Found</option>
                                                    <?php       
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <option value="">No Match Found</option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>  <!-- Org List -->

                                <div class="control-group">
                                    <label for="tasktitel" class="control-label">UserType <span style="color:#F00">*</span></label>
                                    <div class="controls">
                                        <select id="txt_userType" name="txt_userType" class="select2-me input-xlarge" >
                                            <option value="" disabled selected>Select here</option>
                                            <option value="1">Admin</option>
                                            <option value="3">FPO</option>
                                            <option value="2">Change Agent</option>
                                            <!-- <option value="Reviewer">Reviewer</option> -->
                                            <option value="4">Data Entry</option>
                                        </select>
                                    </div>
                                </div>  
                                
                                <div class="control-group">
                                    <label for="text" class="control-label" style="margin-top:10px">
                                        Name <span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="txt_name" name="txt_name" class="input-xlarge v_name" data-rule-required="true" placeholder="Enter Your Name">
                                    </div>
                                </div>  <!-- Name -->
                                
                                <div class="control-group">
                                    <label for="text" class="control-label" style="margin-top:10px">
                                        Email/Username <span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="txt_email" name="txt_email" class="input-xlarge" data-rule-required="true" data-rule-email="true" placeholder="Enter Your Email Address">
                                    </div>
                                </div>  <!-- Email / Username -->
                                
                                <div class="control-group">
                                    <label for="text" class="control-label" style="margin-top:10px">
                                        Password <span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="txt_password" name="txt_password" class="input-xlarge" data-rule-required="true" placeholder="Enter Your Password" >
                                    </div>
                                </div>  <!-- Mother's Name -->
                                
                                <div class="control-group">
                                    <label for="numberfield" class="control-label">
                                        Mobile No. <span style="color:#F00">*</span>
                                    </label>
                                
                                    <div class="controls">
                                        <input type="text" placeholder="Mobile no" name="txt_mobileno" id="txt_mobileno" maxlength="10"  autocomplete="off" data-rule-required="true" data-rule-minlength="10"  data-rule-maxlength="10" class="input-xlarge v_number">
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

            var baseurll            = '<?php echo BASE_FOLDER; ?>';

            $('#add_adminusers').on('submit', function(e) 
            {
                e.preventDefault();
                if ($('#add_adminusers').valid())
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

