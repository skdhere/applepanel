<?php
	include('config/autoload.php');

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
		<!--<link type="text/css" href="css/main.css">-->
    <style type="text/css">
    	/* pagination css */
    	#container1 .pagination{
    		width: 100%;
			height: 25px;
			margin: 0 15px;
			clear: both;
    	}

    	#container1 .pagination ul {
		    float: right;
		}

		.total {
		    margin: 10px;
		    font-family: arial;
		    color: #999;
		    float: left;
		}

		#container1 .pagination ul li.inactive, #container1 .pagination ul li.inactive:hover {
		    background-color: #ededed;
		    color: #bababa;
		    border: 1px solid #bababa;
		    cursor: default;
		}
		#container1 .pagination ul li:hover {
		    background-color: #DDDDDD !important;
		    color: #000;
		    cursor: pointer;
		}
		#container1 .pagination ul li {
		    list-style: none;
		    float: left;
		    border: 1px solid #329ea9;
		    padding: 2px 6px 2px 6px;
		    margin: 0 3px 0 3px;
		    font-family: arial;
		    font-size: 14px;
		    color: #329ea9;
		    font-weight: bold;
		    background-color: #f2f2f2;
		}

		/* pagination css */
    </style>

    </head>
    
    <body class="<?php echo THEME_NAME; ?>" data-theme="<?php echo THEME_NAME; ?>">
        <?php
		/*include Bootstrap model pop up for error display*/
		modelPopUp();
		/*include Bootstrap model pop up for error display*/
		/* this function used to add navigation menu to the page*/
		navigation_menu();
		/* this function used to add navigation menu to the page*/
		?> <!-- Navigation Bar -->
        <div class="container-fluid" id="content">
            <div id="main" style="margin-left:0px !important">
                <?php
				/* this function used to add navigation menu to the page*/
				breadcrumbs($home_url,$home_name,'View FPO',$filename,$feature_name);
				/* this function used to add navigation menu to the page*/
				?>
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="box box-color box-bordered">
                                <div class="box-title">
                                    <h3>
                                        <i class="icon-table"></i>
                                        FPO
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
                                    <div style="padding:20px">
                                        <a href="add_fpo.php?pag=fpo" class="btn btn-primary">
                                            Add FPO
                                        </a>
                                    </div>
                                    <div style="padding:10px 15px 10px 15px !important">
                                    	
                                    	
                                        <input type="hidden" name="hid_page" id="hid_page" value="1">
                                        <input type="hidden" name="cat_parent" id="cat_parent" value="parent">
                                        <select name="rowlimit" id="rowlimit" onChange="loadData();"  class = "select2-me">
                                            <option value="10" selected>10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries per pages
                                        <input type="text" class="input-medium" id = "srch" name="srch" placeholder="Search here..."  style="float:right;margin-right:10px;margin-top:10px;" >
                                    </div>
                                    <div id="req_resp"></div>
                                    <div class="profileGallery">
                                        <div style="width:99%;" align="center">
                                            <div id="loading"></div>                                            
                                            <div id="container1" class="data_container">
                                                <div class="data"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       	</div>
    	<script type="text/javascript">
	        $(document).ready(function(e) {
	            
	            $("#selectall").click(function(){
	                $(".case").attr("checked",this.checked);
	            });
	            
	            $(".case").click(function(){
	                if($(".case").length==$(".case:checked").length){
	                    $("#selectall").attr("checked","checked");
	                }
	                else{
	                    $("#selectall").removeAttr("checked");
	                }
	            });
				
				$('#srch').keypress(function(e) 
				{
					if(e.which == 13) 
					{	
						$("#hid_page").val("1");					
	       			   	loadData();	
					}
				});
				
				loadData();
				
				$('#container1').on('click', '.pagination li.active',function()
				{
					//alert('Hi');
					var page = $(this).attr('p');
					$("#hid_page").val(page);
					loadData();						
				});
	        });
			
			function loadData()
			{
				//loading_show();
				hid_user_type = $('#hid_user_type').val();   
				hid_ca_id     = $('#hid_ca_id').val();
				row_limit     = $.trim($('select[name="rowlimit"]').val());
				search_text   = $.trim($('#srch').val());
				page          = $.trim($("#hid_page").val());
				load_fpo      = "1";			
				if(row_limit == "" && page == "")
				{
					alert('Can not Get Row Limit and Page number');
					//loading_hide();
				}
				else
				{
					var sendInfo 	= {"row_limit":row_limit, "search_text":search_text, "load_fpo":load_fpo, "page":page, "hid_user_type":hid_user_type, "hid_ca_id":hid_ca_id};
					var fpo_load = JSON.stringify(sendInfo);				
					$.ajax({
						url: "load_fpo.php?",
						type: "POST",
						data: fpo_load,
						contentType: "application/json; charset=utf-8",						
						success: function(response) 
						{
							data = JSON.parse(response);
							//alert(data.resp);
							if(data.Success == "Success") 
							{
								$("#container1").html(data.resp);
								//loading_hide();
							} 
							else if(data.Success == "fail") 
							{
								$("#container1").html('<span style="style="color:#F00;">'+data.resp+'</span>');														
								//loading_hide();
							}
						},
						error: function (request, status, error) 
						{
							//loading_hide();
						},
						complete: function()
						{
							//loading_hide();
							//alert("complete");
						}
				    });
				}
			}

			function getXMLHTTP() 
			{ //fuction to return the xml http object
					var xmlhttp=false;	
					try{
						xmlhttp=new XMLHttpRequest();
					}
					catch(e)	{		
						try{			
							xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
						}
						catch(e){
							try{
							xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
							}
							catch(e1){
								xmlhttp=false;
							}
						}
					}
						
					return xmlhttp;
			}

            function sord(c_value,c_id,c_type) 
            {
                
                
                var strURL="findspasorder.php?c_value="+c_value+"&c_id="+c_id+"&c_type="+c_type;
                var req = getXMLHTTP();
                
                if (req) {
                    
                    req.onreadystatechange = function() {
                        if (req.readyState == 4) {
                            // only if "OK"
                            if (req.status == 200) {						
                                document.getElementById('comp_1').innerHTML=req.responseText;						
                            } else {
                                alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                            }
                        }				
                    }			
                    req.open("GET", strURL, true);
                    req.send(null);
                }		
            }
        </script>	<!-- Nice Scroll -->
    </body>
</html>
