<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">

	function getDistrict(state=''){

		loading_show();
		$.ajax({
			url: "action/area.php",
			type: "POST",
			data: {state:state,request:'district'},
			contentType: "application/x-www-form-urlencoded ",						
			success: function(response) 
			{	
				$('#fm_district').html('');
				$('#fm_taluka').html('');
				$('#fm_village').html('');
				data = JSON.parse(response);
				$('#fm_district').html(data.resp);
			},
			error: function (request, status, error) 
			{
				loading_hide();
			},
			complete: function()
			{
				loading_hide();
				//alert("complete");
			}
	    });
	}

	function getTaluka(district=''){

		loading_show();
		$.ajax({
			url: "action/area.php",
			type: "POST",
			data: {district:district,request:'taluka'},
			contentType: "application/x-www-form-urlencoded ",						
			success: function(response) 
			{	
				$('#fm_taluka').html('');
				$('#fm_village').html('');
				data = JSON.parse(response);
				$('#fm_taluka').html(data.resp);
			},
			error: function (request, status, error) 
			{
				loading_hide();
			},
			complete: function()
			{
				loading_hide();
				//alert("complete");
			}
	    });
	}

	function getVillage(taluka=''){

		loading_show();
		$.ajax({
			url: "action/area.php",
			type: "POST",
			data: {taluka:taluka,request:'village'},
			contentType: "application/x-www-form-urlencoded ",						
			success: function(response) 
			{	
				$('#fm_village').html('');
				data = JSON.parse(response);
				$('#fm_village').html(data.resp);
			},
			error: function (request, status, error) 
			{
				loading_hide();
			},
			complete: function()
			{
				loading_hide();
				//alert("complete");
			}
	    });
	}
</script>