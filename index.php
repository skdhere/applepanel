<?php
include('config/autoload.php');
if(isset($_SESSION['sqyard_user']))
{
	header('Location: '.$BaseFolder.'home.php'); 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login Form</title>


	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.new.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="css/themes.css">


	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- Nice Scroll -->
	<script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Validation -->
	<script src="js/plugins/validation/jquery.validate.min.js"></script>
	<script src="js/plugins/validation/additional-methods.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/eakroko.js"></script>
	<style type="text/css">
	
</style>
</head>

<body class="login theme-green" data-theme="theme-green">
	<div class="wrapper">
		<!--<h1><a href="index.php"><img src="img/logo-big.png" alt="" class='retina-ready' width="59" height="49">Admin Panel</a></h1>-->
		<div class="login-body">
			<h2>SIGN IN</h2>
			<form enctype="multipart/form-data" method='post' class='form-validate' id="frm_login">
				<div class="form-group">
					<div class="pw controls">
						<input type="text" autocomplete="off" name="emailId" id="emailId" placeholder="Enter Your Email Address" class="input-block-level form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="pw controls">
						<input type="password" autocomplete="off" name="pwfield" id="pwfield" class="input-block-level form-control" placeholder="Enter Your Password">
					</div>
				</div>
				<div class="submit">
					<input type="submit" value="Sign me in" class='btn btn-primary'>
				</div>
			</form>

			<div class="forget">
				<a href="#"><span>Forgot password?</span></a>
			</div>
		</div>
	</div>

    <?php include('view/footer.php');?>
    <?php include('view/scripts.php');?>

	<script type="text/javascript">


		$( "#frm_login" ).validate( {
		    rules: {
		        emailId: {
		            required: true,
		            email: true,
		            maxlength: 35,
		        },
		        password: {
		            required: true,
		       },
		    },
		    messages: {
		        emailId: {
		            required: "Please enter your email",
		            email: "Please enter valid email address",
		        },
		        password:{
		            required: "Please enter your password",
		        }
		    },
		    errorElement: "em",
		    errorPlacement: function ( error, element ) {
		// Add the `help-block` class to the error element
		error.addClass( "help-block" );

		element.addClass( "input-error" );
		if ( element.prop( "type" ) === "checkbox" ) {

		    error.insertAfter( element.parent( "label" ) );
		} else {
		    error.insertAfter( element );
		}
		},
		highlight: function ( element, errorClass, validClass ) {

			$(element).addClass( "input-error" );
		    $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			console.log(element,errorClass,validClass);
			$(element).removeClass( "input-error" );
		    $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function (form)
        {
            if (typeof FormData !== 'undefined')
            {
            	var formData = new FormData($("#frm_login")[0]);
            	$.ajax(
                {
                    url: "action/login.php?request=authenticate",
                    type: "POST",
                    dataType: "json",
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data)
                    {
                        if (data.success == true)
                        {
                            var message = "<div class='form-group message'><div class='alert alert-success alert-dissmissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'></button><strong>Success! </strong>" + data.message + "</div></div>";

                            $("#frm_login").first('.form-group').prepend(message);
                            $(".message").fadeOut(5000);
                            $(".error").html("");

                            setTimeout(function() { 
                                if(data.request_url==""){
                                	window.location.href ='home.php';
                                 }else{
                                 	window.location.href =data.request_url;
                                 }
                            }, 5000);
                            
                        } else if (data.success == false)
                        {
                            $('#btn-register').prop('disabled',false);
                            $(".error").html("");
                            if (data.message)
                            {
                                var message = "<div class='form-group message'><div class='alert alert-danger alert-dissmissible fade show' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'></button><strong>Fail! &nbsp;&nbsp;</strong>" + data.message + "</div></div>";
                                $("#frm_login").first('form-group').prepend(message);
                                $(".message").fadeOut(5000);
                                
                            }
                        }
                    }
                });
            }
        }
		} );

		// $('#frm_login').on('submit', function(e) 
		// {
		// 	e.preventDefault();
		// 	if ($('#frm_login').valid())
		// 	{
		// 		var username	= $.trim($('input[name="emailId"]').val());
		// 		var password 	= $.trim($('input[name="pwfield"]').val());
		// 		var getLogin	= '1';
		// 		var sendInfo	= {"username":username,"password":password, "getLogin":getLogin};
		// 		var get_login	= JSON.stringify(sendInfo);

		// 		$.ajax({
		// 			url: "include/connection.php?",
		// 			type: "POST",
		// 			data: get_login,
		// 			contentType: "application/json; charset=utf-8",						
		// 			success: function(response) 
		// 			{
		// 				data = JSON.parse(response);
		// 				if(data.Success == "Success") 
		// 				{
		// 						// Redirect to link_page.php
		// 						window.location.assign("<?php echo BASE_FOLDER; ?>"+data.resp);
		// 					} 
		// 					else 
		// 					{
		// 						// reset the fields
		// 						$('#emailId').val('');
		// 						$('#pwfield').val('');
		// 						alert(data.resp);
		// 					}
		// 				},
		// 				error: function (request, status, error) 
		// 				{
							
		// 				},
		// 				complete: function()
		// 				{
		// 				}
		// 			});	
		// 	}				
		// });

	</script>

</body>
</html>
