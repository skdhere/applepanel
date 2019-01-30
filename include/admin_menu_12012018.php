<?php

if($_SESSION['userType']=="changeagent")
{
?>
<ul class='main-nav'>
				<li>
					<a href="home.php">
						<i class="icon-home"></i>
						<span>Dashboard</span>
					</a>
				</li>
                <li <?php if(isset($_REQUEST['pag'])&&($_REQUEST['pag'])=='farmers'){?> class="active" <?php } ?>>
					<a href="view_farmers.php?pag=farmers">
						<i class="icon-th-large"></i>
						<span>Farmers</span>
					</a>
				</li> </ul>
<?php
}
elseif($_SESSION['userType']=="Admin")
{
	?>
		<ul class='main-nav'>
			
			<li>
				<a href="home.php">
					<i class="icon-home"></i>
					<span>Dashboard</span>
				</a>
			</li>

			<li <?php if(isset($_REQUEST['pag'])&&($_REQUEST['pag'])=='farmers'){?> class="active" <?php } ?>>
				<a href="view_farmers.php?pag=farmers">
					<i class="icon-th-large"></i>
					<span>Farmers</span>
				</a>
			</li>

			<li <?php if(isset($_REQUEST['pag'])&&($_REQUEST['pag'])=='adminusers'){?> class="active" <?php } ?>>
				<a href="view_adminusers.php?pag=adminusers">
					<i class="icon-th-large"></i>
					<span>Admin</span>
				</a>
			</li>

			<li <?php if(isset($_REQUEST['pag'])){?> class="active" <?php } ?> id="li_report" > <!-- onClick="getOpen(this.id);" -->
				<a href="#">
					<i class="icon-th-large"></i>
					<span>Reports</span>
					<span class="caret"></span>
				</a>
				<!-- <ul class="dropdown-menu">
					<li>
						<a href="report_crop_varity.php?pag=crop_varity">Crop Varity Report</a>
					</li>
					<li>
						<a href="report_acreage_for_crop.php?pag=crop_acreage">Crop Acreage Report</a>
					</li>
					<li>
						<a href="report_seasson_wise_crop.php?pag=crop_seasson">Crop Seasson Report</a>
					</li>
					<li>
						<a href="report_crop_grown.php?pag=crop_grown">Crop Grown Report</a>
					</li>
				</ul> -->
			</li>

		</ul>
<?php
}
?>
<div class="user">
    <div class="dropdown asdf">
        <a href="#" class='dropdown-toggle' data-toggle="dropdown">
            <?php echo $_SESSION['sqyard_user']; ?> <i class="icon-user"></i> <span class="caret"></span>
        </a>
        <ul class="dropdown-menu pull-right">
            <li>
                <a href="#">Edit profile</a>
            </li>
            <li>
                <a href="logout.php">Sign out</a>
            </li>
        </ul>
    </div>
</div>

<!-- <script type="text/javascript">
	// function getOpen(elementId)
	// {
	// 	var chk_hasClass = $("#"+elementId).hasClass("open");

	// 	if(chk_hasClass == false)
	// 	{
	// 		// Add Open Class
	// 		$("#"+elementId).addClass("open");
	// 	}
	// 	else
	// 	{
	// 		// Remove Open Class
	// 		$("#"+elementId).removeClass("open");
	// 	}
	// }
</script> -->
