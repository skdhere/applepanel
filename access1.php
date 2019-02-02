<?php 

if(isset($_SESSION['sqyard_user']))
{
	$user 		= $_SESSION['sqyard_user'];
	$userType	= $_SESSION['userType'];
	$login_id	= $_SESSION['login_id'];	 
}
else
{
	?>
	<script type="text/javascript">
		alert("Please login with your username and password.");
		window.open('index.php','_self');
	</script>
	<?php
	//header('Location:index.php');
}

?>