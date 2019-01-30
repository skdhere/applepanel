<?php
	include('access1.php');
	include('include/connection.php');
	

	$feature_name 	= 'FPO';
	$home_name    	= "Home";
	$title			= 'View FPO';
	$home_url 	  	= "home.php";
	$filename		= 'view_fpo.php';
	
	if(!isset($_SESSION['sqyard_user']) && $_SESSION['sqyard_user']=="")
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
                                    Add FPO
                                </h3>
                            </div>
                            <div class="box-content nopadding">
                            <form method="POST" enctype="multipart/form-data" class='form-horizontal form-bordered form-validate' id="add_fpo_users" name="add_fpo_users">
                                
                                <input type="hidden" id="hid_user_reg" name="hid_user_reg" value="1">
                                <input type="hidden" name="txt_userType" id="txt_userType" value="FPO">

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
                                    <label for="numberfield" class="control-label">
                                        Mobile No. <span style="color:#F00">*</span>
                                    </label>
                                
                                    <div class="controls">
                                        <input type="text" placeholder="Mobile no" name="txt_mobileno" id="txt_mobileno" maxlength="10"  autocomplete="off" data-rule-required="true" data-rule-minlength="10"  data-rule-maxlength="10" class="input-xlarge v_number">
                                        <label id="comp_2" style="color:#FF0000;width:200px;margin-left:100px;"></label>    
                                    </div>
                                </div> <!-- Mobile No -->

                                <div class="control-group">
                                    <label for="text" class="control-label" style="margin-top:10px">
                                        Password <span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="text" id="txt_password" name="txt_password" class="input-xlarge" data-rule-required="true" placeholder="Enter Your Password" >
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

            var baseurll            = '<?php echo $BaseFolder; ?>';

            $('#add_fpo_users').on('submit', function(e) 
            {
                e.preventDefault();
                if ($('#add_fpo_users').valid())
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
                                    location.href   = baseurll + "/view_fpo.php?pag=fpo";
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

