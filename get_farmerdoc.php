<?php
	include('access1.php');
	include('include/connection.php');
	

	$feature_name 	= 'Farmer';
	$home_name    	= "Home";
	$title			= 'View Farmer';
	$home_url 	  	= "home.php";
	$filename		= 'view_farmers.php';
	
	if(!isset($_SESSION['sqyard_user']) && $_SESSION['sqyard_user']=="")
	{
		?>
		<script type="text/javascript">
        history.go(-1);
        </script>
        <?php	
	}
	$fm_id = $_REQUEST['fm_id'];

	$ca_id = $_SESSION['ca_id'];
    if($_SESSION['userType']=="Admin")
    {
        $sql   = "select * from tbl_farmers order by id desc";
    }
    else
    {
       $sql = "select * from tbl_farmers where fm_caid='".$ca_id."' order by id desc";
    }
	$res	= mysqli_query($db_con,$sql) or die(mysqli_error($db_con));


$sql_doc="SELECT * FROM tbl_doc_uploads where  fm_id='$fm_id'";
$res_doc=mysqli_query($db_con,$sql_doc);



	$r = 1;	
?>	
<!doctype html>
<html>
    <head>
        <?php
        /* This function used to call all header data like css files and links */
        headerdata($feature_name);
        /* This function used to call all header data like css files and links */
    	?>

        <script>
        $(document).ready(function(){
            $.validator.addMethod(
                "filesize",
                function(value, element) {
                    if (window.File && window.FileList) {
                        if ($(element).attr('type') == "file"
                            && ($(element).hasClass('required')
                                || element.files.length > 0)) {
                            var size  = 0;
                        var $form = $(element).parents('form').first();
                        var $fel = $form.find('input[type=file]');
                        var $max = $form.find('input[name=MAX_FILE_SIZE]').first();
                        if ($max) {
                            for (var j=0, fo; fo=$fel[j]; j++) {
                                files  = fo.files;
                                for (var i=0, f; f=files[i]; i++) {
                                    size += f.size;
                                }
                            }
                            return size <= $max.val();
                        }
                    }
                }
                return true;
            },
            "The file(s) selected exceed the file size limit. Please choose another file."
            );
        });
    </script>
    <!-- Added by satish for prettyphoto 12042018  -->
    <link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
    <script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>

    <style type="text/css">
    .wide {
            border-bottom: 1px #000 solid;
            width: 4000px;
        }
        
        .fleft { float: left; margin: 0 20px 0 0; }
        
        .cboth { clear: both; }
        
        #main {
            background: #fff;
            margin: 0 auto;
            padding: 30px;
            width: 1000px;
        }
    </style>
    <!-- End Added by satish -->

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
                <div class="container">

                    

                    <div class="col-md-12">
                            <hr class="visible-sm visible-xs lg">
                            
                            <div class="box box-color box-bordered green">
                            <div class="box-title">
                                <h3>
                                 Upload Images, Document and Forms
                                </h3>
                            </div>
                            <div class="box-content nopadding">
                                <form action="farmerdoc_upload.php?pag=farmers&fm_id=<?php echo $fm_id;  ?>" method="POST" class='form-horizontal form-validate' enctype="multipart/form-data" id="ssss12">
                                    
                                    
                                    <input type="hidden" value="5048576" name="MAX_FILE_SIZE">

                                    <div class="control-group">
                                         <label for="textfield" class="control-label">Farmer's Photo </label>
                                         <div class="controls">
                                            <input type="file" class="filesize" name="files8[]" multiple data-rule-extension="true"  accept="application/pdf,image/jpeg,image/png"/><span class="help-block" style="font-weight:bold;color:#7ebd28">max size 5MB (jpg,png,pdf)</span>
                                         </div>
                                     </div> <!-- Profile Photo -->

                                     <div class="control-group">
                                         <label for="textfield" class="control-label">Upload Aadhar </label>
                                         <div class="controls">
                                            <input type="file" class="filesize" name="files1[]" multiple data-rule-extension="true"  accept="application/pdf,image/jpeg,image/png"/><span class="help-block" style="font-weight:bold;color:#7ebd28">max size 5MB (jpg,png,pdf)</span>
                                         </div>
                                     </div> <!-- aadhar -->
                                     <div class="control-group">
                                         <label for="textfield" class="control-label">Upload Pancard </label>
                                         <div class="controls">
                                            <input type="file" class="filesize" name="files2[]" multiple data-rule-extension="true" accept="application/pdf,image/jpeg,image/png"/><span class="help-block" style="font-weight:bold;color:#7ebd28">max size 5MB (jpg,png,pdf)</span>
                                         </div>
                                     </div>

                                     <div class="control-group">
                                         <label for="textfield" class="control-label">Upload 7/12 </label>
                                         <div class="controls">
                                            <input type="file" class="filesize" name="files3[]" multiple data-rule-extension="true"   accept="application/pdf,image/jpeg,image/png"/><span class="help-block" style="font-weight:bold;color:#7ebd28">max size 5MB (jpg,png,pdf)</span>
                                         </div>
                                     </div>

                                     <div class="control-group">
                                         <label for="textfield" class="control-label">Upload Land Registration </label>
                                         <div class="controls">
                                            <input type="file" class="filesize" name="files4[]" multiple data-rule-extension="true"  accept="application/pdf,image/jpeg,image/png"/><span class="help-block" style="font-weight:bold;color:#7ebd28">max size 5MB (jpg,png,pdf)</span>
                                         </div>
                                     </div>

                                     <div class="control-group">
                                         <label for="textfield" class="control-label">Upload Land Valuation</label>
                                         <div class="controls">
                                            <input type="file" class="filesize" name="files5[]" multiple data-rule-extension="true"  accept="application/pdf,image/jpeg,image/png"/><span class="help-block" style="font-weight:bold;color:#7ebd28">max size 5MB</span>
                                            
                                         </div>
                                     </div>

                                     <div class="control-group">
                                         <label for="textfield" class="control-label">Upload Soil Test Documents </label>
                                         <div class="controls">
                                            <input type="file" class="filesize" name="files6[]" multiple  data-rule-extension="true" accept="application/pdf,image/jpeg,image/png"/><span class="help-block" style="font-weight:bold;color:#7ebd28">max size 5MB (jpg,png,pdf)</span>
                                         </div>
                                     </div>

                                     <div class="control-group">
                                         <label for="textfield" class="control-label">Kisan Credit Card </label>
                                         <div class="controls">
                                            <input type="file" class="filesize" name="files7[]" multiple  data-rule-extension="true" accept="application/pdf,image/jpeg,image/png"/><span class="help-block" style="font-weight:bold;color:#7ebd28">max size 5MB (jpg,png,pdf)</span>
                                         </div>
                                     </div>
                                     
                                    <div class="form-actions">
                                        <input type="reset" class="btn" value="Back" id="back">
                                        <input type="submit" class="btn btn-primary" name="U_Submit" id="U_Submit" value="Submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="box box-color box-bordered green">
                                <div class="box-title">
                                    <h3>
                                        <i class="icon-table"></i>
                                        Uploaded Details Images, Document and Forms
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                   
                                    <form id="mainform1" action="deletefarmerdoc.php?pag=farmers&fm_id=<?php echo $fm_id; ?>" method="post">
                                        <div id="comp_1">
                                            <table class="table table-bordered ">
                                                <thead >
                                                    <tr>
                                                        <th>Sr no.</th>
                                                        <th>Farmer ID</th>
                                                        <th>Docs Upload</th>
                                                        <th>Document Type</th>
                                                        <th>Status</th>
                                                        <th class='hidden-350'>Created Date</th>
                                                         <th style="text-align:center" class='hidden-480'><a href="#"><input type="checkbox" id="selectall" /></a>

                        <input type="submit" name="main" value="Delete" style="margin-left:10px; width:80px;height:30px;font-size:16px" /></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="gallery clearfix">

                                                    <?php
                                                     while($row_doc = mysqli_fetch_array($res_doc))
                                                        {
                                                    ?>
                                                    
                                                        <tr>
                                                            <td><?php echo $r; ?></td>  <!-- Sr. No. -->
                                                            <td><?php echo $row_doc['fm_id']; ?></td>   <!-- Farmer ID -->
                                                            <td>
                                                               <?php if($row_doc['file_extention'] === "pdf")
                                                                {
                                                                 ?>   
                                                                    <a target="_blank" href="<?php echo "data/".$row_doc['fm_id']."/".$row_doc['file_name']; ?>"/><?php echo $row_doc['file_name']; ?></a>      
                                                                 <?php
                                                                }
                                                                elseif($row_doc['file_extention'] === "jpg" || $row_doc['file_extention'] === "JPG" || $row_doc['file_extention'] === "jpeg" || $row_doc['file_extention'] === "JPEG")
                                                                {
                                                                 ?>
                                                                    <a href="<?php echo "data/".$row_doc['fm_id']."/".$row_doc['file_name']; ?>" rel="prettyPhoto[gallery2]"><img src="<?php echo "data/".$row_doc['fm_id']."/".$row_doc['file_name']; ?>" width="100" height="100" alt="" /></a> 
                                                                 <?php
                                                                }
                                                                elseif($row_doc['file_extention'] === "png")
                                                                {
                                                                 ?>
                                                                 <a href="<?php echo "data/".$row_doc['fm_id']."/".$row_doc['file_name']; ?>" rel="prettyPhoto[gallery2]"><img src="<?php echo "data/".$row_doc['fm_id']."/".$row_doc['file_name']; ?>" width="100" height="100" alt="" /></a>
                                                                 <?php
                                                                }
                                                            ?>
                                                            </td>   <!-- Farmer Name -->
                                                            <td><?php echo $row_doc['doc_type']; ?></td>   <!-- document type -->
                                                            <td><?php echo $row_doc['status']; ?></td>   <!-- Status -->
                                                            <td><?php echo $row_doc['created_date']; ?></td>    <!-- Created Date -->
                                                            
                                                            <td><div align="center"><input type="checkbox" class="case" name="docs[]" value="<?php echo $row_doc['id']?>" /></div></td>
                                                        </tr>
                                                        <?php
                                                        $r++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>      
                            
                            
                        </div>
                </div>
            </section>
            <!-- Page Content / End -->

            <!-- Added by satish for pretty photo -->
            <script type="text/javascript" charset="utf-8">
            $(document).ready(function(){
                $("area[rel^='prettyPhoto']").prettyPhoto();
                
                $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({
                    animation_speed:'normal',
                    theme:'light_square',
                    slideshow:3000, 
                    autoplay_slideshow: false,
                    social_tools: "", 
					deeplinking: false
                });

                $(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({
                    animation_speed:'fast',
                    slideshow:10000,
                     hideflash: true,
                     social_tools: "",
					deeplinking: false
                 });
            });
            </script>

	</body>
</html>
