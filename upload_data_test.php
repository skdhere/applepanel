<?php
	include('access1.php');
	include('include/connection.php');
	

	$feature_name 	= 'Upload Data';
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
                                    Upload Farmers
                                </h3>
                            </div>
                            <div class="box-content nopadding">
                            <form method="POST" enctype="multipart/form-data" class='form-horizontal form-bordered form-validate' id="upload_file" name="upload_file">
                                
                                <input type="hidden" id="hid_user_reg" name="hid_user_reg" value="1">
                                <input type="hidden" name="txt_userType" id="txt_userType" value="FPO">

                               

                                <div class="control-group">
                                    <label for="text" class="control-label" style="margin-top:10px">
                                        File <span style="color:#F00">*</span>
                                    </label>
                                    <div class="controls">
                                        <input type="file" id="file" name="file" class="input-xlarge" data-rule-required="true">
                                    </div>
                                </div>  <!-- File -->

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

            $('#upload_file').on('submit', function(e) 
            {
                e.preventDefault();
                if ($('#upload_file').valid())
                {
                    
                    $.ajax({
                        url: "import_excel.php?",
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
                                    alert('Data uploaded successfully');
                                    location.reload();
                                } 
                                else 
                                {   
                                    alert(data.resp);
                                    // location.href   = baseurll + "/error-404";
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

