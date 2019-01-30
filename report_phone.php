<?php
    include('access1.php'); 
    include('include/connection.php');
    
    $feature_name   = 'Types of Phone Reports';
    $home_name      = "Home";
    $title          = 'SqoreYard | Types of Phone Report';
    $home_url       = "home.php";
    $filename       = 'report_user.php';

    if((isset($_REQUEST['pag'])) && (($_REQUEST['pag'] == 'smartphone') || ($_REQUEST['pag'] == 'featurephone')))
    {
        $page   = $_REQUEST['pag'];
    }
    else
    {
        header("Location:home.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
        /* This function used to call all header data like css files and links */
        headerdata($feature_name);
        /* This function used to call all header data like css files and links */
        ?>
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
    <body class="<?php echo $theme_name; ?>" data-theme="<?php echo $theme_name; ?>">
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
                breadcrumbs($home_url,$home_name,$feature_name,$filename,'Reports');
                /* this function used to add navigation menu to the page*/
                ?>
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="box box-color box-bordered" >
                                <div class="box-title">
                                    <h3><i class="icon-dashboard"></i><?php echo $feature_name; ?></h3>
                                    <div style="margin-left: 22%;">
                                        <select id="ddl_type_of_phones" name="ddl_type_of_phones" class="select2-me input-large" onChange="getTypeOfPhone(this.value);" >
                                            <option value="smartphone" <?php if($page == 'smartphone'){ ?> selected <?php } ?>>Smart Phones</option>
                                            <option value="featurephone" <?php if($page == 'featurephone'){ ?> selected <?php } ?>>Featured Phones</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="clear:both">&nbsp;</div>
                                <div style="padding:10px 15px 10px 15px !important">
                                    <input type="hidden" name="hid_user_type" id="hid_user_type" value="<?php echo $_SESSION['userType'] ?>">
                                    <input type="hidden" name="hid_ca_id" id="hid_ca_id" value="<?php echo $ca_id; ?>">
                                    <input type="hidden" name="hid_page" id="hid_page" value="1">
                                    <input type="hidden" name="hid_page_type" id="hid_page_type" value="<?php echo $page; ?>">
                                    <select name="rowlimit" id="rowlimit" onChange="loadFarmerData();"  class = "select2-me input-small">
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
        <script type="text/javascript">
            $(document).ready(function(e) {
                
                $('#srch').keypress(function(e) 
                {
                    if(e.which == 13) 
                    {   
                        $("#hid_page").val("1");                    
                        loadFarmerData();   
                    }
                });
                
                loadFarmerData();
                
                $('#container1').on('click', '.pagination li.active',function()
                {
                    //alert('Hi');
                    var page = $(this).attr('p');
                    $("#hid_page").val(page);
                    loadFarmerData();                       
                });
            });

            function getTypeOfPhone(phone_type)
            {
                $("#hid_page_type").val(phone_type);
                loadFarmerData();                
            }

            function loadFarmerData()
            {
                //loading_show();
                hid_user_type = $('#hid_user_type').val();   
                hid_ca_id     = $('#hid_ca_id').val();
                row_limit     = $.trim($('select[name="rowlimit"]').val());
                search_text   = $.trim($('#srch').val());
                page          = $.trim($("#hid_page").val());
                hid_page_type = $.trim($("#hid_page_type").val());
                load_farmer   = "1";          
                if(row_limit == "" && page == "")
                {
                    alert('Can not Get Row Limit and Page number');
                    //loading_hide();
                }
                else
                {
                    var sendInfo    = {"row_limit":row_limit, "search_text":search_text, "load_farmer":load_farmer, "page":page, "hid_user_type":hid_user_type, "hid_ca_id":hid_ca_id, "hid_page_type":hid_page_type};
                    var farmer_load = JSON.stringify(sendInfo);             
                    $.ajax({
                        url: "load_report_phone.php?",
                        type: "POST",
                        data: farmer_load,
                        contentType: "application/json; charset=utf-8",                     
                        success: function(response) 
                        {
                            data = JSON.parse(response);
                            //alert(data.resp);
                            if(data.Success == "Success") 
                            {
                                $("#container1").html(data.resp);
                            } 
                            else if(data.Success == "fail") 
                            {
                                $("#container1").html('<span style="style="color:#F00;">'+data.resp+'</span>');
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
        </script>
    </body>
</html>