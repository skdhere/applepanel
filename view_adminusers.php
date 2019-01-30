<?php
	include('access1.php');
	include('include/connection.php');
	

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
                                    View Users
                                </h3>
                            </div>
                            <div class="box-content nopadding">
                                <div style="padding:20px">
                                        <a href="add_adminusers.php?pag=adminusers" class="btn btn-primary">
                                            Add User
                                        </a>
                                    </div>
                                <form id="mainform1" action="deleteadminusers.php?pag=adminusers" method="post">
                                    <div id="comp_1">
                                        <table class="table table-bordered dataTable dataTable-scroll-x">
                                            <thead>
                                                <tr>
                                                    <th>Sr no.</th>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Username</th>
                                                    <th>Password</th>
                                                    <th>Contact No</th>
                                                    <th>Type</th>
                                                    <th>Status</th>
                                                    <th class='hidden-350'>Created Date</th>
                                                    <th>Edit</th>
                                                    <th style="text-align:center" class='hidden-480'><a href="#"><input type="checkbox" id="selectall" /></a>

                                                        <input type="submit" name="main" value="Delete" style="margin-left:10px; width:80px;height:30px;font-size:16px" /></th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    while($row_doc = mysqli_fetch_array($res))
                                                    {
                                                        ?>
                                                        
                                                        <tr>
                                                            <td><?php echo $r; ?></td>  
                                                            <td><?php echo $row_doc['id']; ?></td>
                                                            <td><?php echo $row_doc['fname']; ?></td>
                                                            <td><?php echo $row_doc['emailId']; ?></td>  
                                                            <td><?php echo $row_doc['password']; ?></td> 
                                                            <td><?php echo $row_doc['contactno']; ?></td><td><?php echo $row_doc['userType']; ?></td>   <!-- document type -->
                                                       <td><?php if($row_doc['reg_status']=='1'){
                                                            echo "Active";
                                                       }else{
                                                            echo "Inactive";
                                                       }  ?></td>   <!-- Status -->
                                                       <td><?php echo $row_doc['register_dt']; ?></td>    <!-- Created Date -->
                                                      <td><a href="edit_adminusers.php?pag=adminusers&admin_id=<?php echo $row_doc['id']; ?>" class="btn btn-primary">Edit</a></td>
                                                       <td><div align="center"><input type="checkbox" class="case" name="adminusers[]" value="<?php echo $row_doc['id']?>" /></div></td>
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
        </section>
            <!-- Page Content / End -->



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

