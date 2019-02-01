<?php
    function generateRandomStringMobileVerification($length)
	{
		$characters = '123456789';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) 
		{
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
	
	
	
	function loader()
	{
		?>
        <div id="lodermodal"></div>
        <div id="loderfade"></div>
        <script type="text/javascript">
            
           $(document).ready(function()
           {
        
                $('.frm-link').on('click', function(){
                        var ids    =this.id;
                        var ids    = ids.split('_');
                        var fm_id  =ids[1];
                        var frm_id =ids[0];
                        go_to_form(frm_id,fm_id);
                    });
               
           });
        
        
           function loading_show()
            {
                document.getElementById('lodermodal').style.display = 'block';
                document.getElementById('loderfade').style.display = 'block';
            }
           
           function loading_hide()
            {
                document.getElementById('lodermodal').style.display = 'none';
                document.getElementById('loderfade').style.display = 'none';
            }
        
            
            
        </script>
		<?php 
	}
	
	function headerdata($feature_name)
	{
		?>
		<title><?php echo $feature_name; ?></title>
        <meta charset="utf8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- Apple devices fullscreen -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Apple devices fullscreen -->
        <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        
    
        <!-- Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- <link rel="stylesheet" href="css/bootstrap.min.new.css"> -->
        <!-- Bootstrap responsive -->
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
        <!-- jQuery UI -->
        <link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
        <!-- PageGuide -->
        <link rel="stylesheet" href="css/plugins/pageguide/pageguide.css">
        <!-- Fullcalendar -->
        <link rel="stylesheet" href="css/plugins/fullcalendar/fullcalendar.css">
        <link rel="stylesheet" href="css/plugins/fullcalendar/fullcalendar.print.css" media="print">
        <!-- chosen -->
        <link rel="stylesheet" href="css/plugins/chosen/chosen.css">
        <!-- select2 -->
        <link rel="stylesheet" href="css/plugins/select2/select2.min.css">
        <!-- icheck -->
        <link rel="stylesheet" href="css/plugins/icheck/all.css">
        <!-- Theme CSS -->
        <link rel="stylesheet" href="css/style.css">
        <!-- Color CSS -->
        <link rel="stylesheet" href="css/themes.css">
    
    	<link rel="stylesheet" href="css/plugins/datepicker/datepicker.css">
        
    
        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>
        <!-- Nice Scroll -->
        <script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- jQuery UI -->
        <script src="js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
        <script src="js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
        <script src="js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
        <script src="js/plugins/jquery-ui/jquery.ui.draggable.min.js"></script>
        <script src="js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
        <script src="js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
        <!-- Touch enable for jquery UI -->
        <script src="js/plugins/touch-punch/jquery.touch-punch.min.js"></script>
        <!-- slimScroll -->
        <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <!-- vmap -->
        <script src="js/plugins/vmap/jquery.vmap.min.js"></script>
        <script src="js/plugins/vmap/jquery.vmap.world.js"></script>
        <script src="js/plugins/vmap/jquery.vmap.sampledata.js"></script>
        <!-- Bootbox -->
        <script src="js/plugins/bootbox/jquery.bootbox.js"></script>
        <!-- Flot -->
        <script src="js/plugins/flot/jquery.flot.min.js"></script>
        <script src="js/plugins/flot/jquery.flot.bar.order.min.js"></script>
        <script src="js/plugins/flot/jquery.flot.pie.min.js"></script>
        <script src="js/plugins/flot/jquery.flot.resize.min.js"></script>
        <!-- imagesLoaded -->
        <script src="js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
        <!-- PageGuide -->
        <script src="js/plugins/pageguide/jquery.pageguide.js"></script>
        <!-- FullCalendar -->
        <script src="js/plugins/fullcalendar/fullcalendar.min.js"></script>
        <!-- Chosen -->
        <script src="js/plugins/chosen/chosen.jquery.min.js"></script>
        <!-- select2 -->
        <script src="js/plugins/select2/select2.min.js"></script>
        <!-- icheck -->
        <script src="js/plugins/icheck/jquery.icheck.min.js"></script>
    
        <!-- Theme framework -->
        <script src="js/eakroko.min.js"></script>
        <!-- Theme scripts -->
        <script src="js/application.min.js"></script>
        <!-- Just for demonstration -->
    
        
        <script src="js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
        <!--	<script src="js/bootstrap.min.js"></script> -->	
        <script src="js/plugins/validation/jquery.validate.min.js"></script>
        <script src="js/plugins/validation/additional-methods.min.js"></script>
        <script src="js/plugins/wizard/jquery.form.wizard.min.js"></script>
        <script src="js/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="js/js_validator.js"></script>
		
		<script type="text/javascript">
        	$(document).ready(function(){
				//$('.datepicker').datepicker({format:'yyyy-mm-dd'});	
				$('.datepicker').datepicker({format:'yyyy-mm-dd'});	
			});
        </script>
                
        <!-- Favicon -->
        <link rel="shortcut icon" href="img/favicon.ico" />
        
        <!-- Apple devices Homescreen icon -->
        <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />
		<?php
	}
	
	function modelPopUp()
	{
		?>
		<div class="modal fade" id="error_model" role="dialog">
		<div class="modal-dialog">    
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body text-center" id="model_body">
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		  </div>      
		</div>
	  </div>
		<?php
	}
	
	function navigation_menu()
	{
		?>
			<div id="navigation">
				<div class="container-fluid" >
					<a href="http://www.sqoreyard.com/sqyardpanel/home.php" id="brand">
                    	Admin Panel<!--<img src="img/logo.png" style="height:40px;">-->
                    </a>
                    <!-- main menu -->
					<?php 
						$filepath = "include/admin_menu.php";
						include($filepath);
					?>
					<!-- main menu -->
				</div>
			</div>	
		<?php
	}
	
	function breadcrumbs($home_url,$home_name,$title,$filename,$feature_name)
	{
		?>
			<div class="page-header">
				<div class="pull-left">
					<h1><?php print $feature_name ?></h1>
				</div>
				<?php 
					date_default_timezone_set("Asia/Calcutta");
					$dt=date('F d, Y');
					$week=date('l');
				?>
				<div class="pull-right" style="margin-left:5px;">
					<ul class="stats">
						<li class='lightred'>
							<i class="icon-calendar"></i>
							<div class="details">
								<span class="big"><?php echo $dt; ?></span>
								<span><?php echo $week; ?></span>
							</div>
						</li>
					</ul>
				</div>
			</div> <!-- date BOX on right side-->
			<div class="breadcrumbs">
				<ul>
					<li>
						<a href="<?php echo $home_url; ?>"><?php echo $home_name; ?></a>
						<i class="icon-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo $filename; ?>?pag=<?php echo $feature_name; ?>"><?php echo $feature_name; ?></a>
						<i class="icon-angle-right"></i>
					</li>
					<li>
						<a href="#"><?php echo $title; ?></a>
					</li>
				</ul>
				<?php /*?><div class="close-bread">
					<a href="#"><i class="icon-remove"></i></a>
				</div><?php */?>
			</div> <!--breadcrumb-->
		<?php
	}

function getRecord($table ,$where, $not_where_array=array(), $and_like_array=array(), $or_like_array=array(),$order_by = array())
{
    global $db_con;
    if($table=="")
    {
        quit('Table name can not be blank');
    }
    $sql = " SELECT * FROM ". $table ;
    $fields = array();
    $values = array();
    
    
    $sql .=" WHERE 1 = 1 ";
    
    //==Check Where Condtions=====//
    if(!empty($where))
    {
        foreach($where as $field1 => $value1 )
        {   
            $sql  .= " AND ".$field1 ."='".$value1."' ";
        }
    }
    
    //==Check Not Where Condtions=====//
    if(!empty($not_where_array))
    {
        foreach($not_where_array as $field2 => $value2)
        {   
            $sql  .= " AND ".$field2 ."!='".$value2."' ";
        }
    }
    if(!empty($order_by))
    {
        foreach($order_by as $col => $order)
        {   
            $sql  .= " ORDER BY  ".$col ." ".$order." ";
        }
    }
    $result         = mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
    $num            = mysqli_num_rows($result);
    if($num > 0)
    {
        
        return $result;
    }
    else
    {
        return false;
    }
}


function query($sql)
{
    global $db_con;
    $result = mysqli_query($db_con,$sql) or die(mysqli_error($db_con));
    return $result;
}

    ?>

