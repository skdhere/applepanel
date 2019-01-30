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
				<li <?php if(isset($_REQUEST['pag'])&&($_REQUEST['pag'])=='farmers'){?> class="active" <?php } ?>>
					<a href="view_farmers.php?pag=farmers">
						<i class="icon-th-large"></i>
						<span>Admin</span>
					</a>
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
