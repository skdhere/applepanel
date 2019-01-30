<?php
    include('access1.php'); 
    include('include/connection.php');
    
    $feature_name   = 'Loan Type Reports';
    $home_name      = "Home";
    $title          = 'SqoreYard | Loan Type Report';
    $home_url       = "home.php";
    $filename       = 'report_user.php';

    if((isset($_REQUEST['pag'])) && (isset($_REQUEST['type_loan'])) && $_REQUEST['pag'] == 'loan_type')
    {
        $page   = $_REQUEST['type_loan'];
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
                                        <select id="ddl_type_loan" name="ddl_type_loan" class="select2-me input-large" onChange="getTypeOfLoan(this.value);" >
                                            <option value="Education" <?php if($page == 'Education'){ ?> selected <?php } ?>>Education</option>
                                            <option value="Land" <?php if($page == 'Land'){ ?> selected <?php } ?>>Land</option>
                                            <option value="Agriculture" <?php if($page == 'Agriculture'){ ?> selected <?php } ?>>Agriculture</option>
                                            <option value="Two Wheeler" <?php if($page == 'Two Wheeler'){ ?> selected <?php } ?>>Two Wheeler</option>
                                            <option value="Equipment" <?php if($page == 'Equipment'){ ?> selected <?php } ?>>Equipment</option>
                                            <option value="Irrigation" <?php if($page == 'Irrigation'){ ?> selected <?php } ?>>Irrigation</option>
                                            <option value="Fencing" <?php if($page == 'Fencing'){ ?> selected <?php } ?>>Fencing</option>
                                            <option value="Housing" <?php if($page == 'Housing'){ ?> selected <?php } ?>>Housing</option>
                                            <option value="Construction OR Renovation" <?php if($page == 'Construction OR Renovation'){ ?> selected <?php } ?>>Construction OR Renovation</option>
                                            <option value="Four Wheeler" <?php if($page == 'Four Wheeler'){ ?> selected <?php } ?>>Four Wheeler</option>
                                            <option value="Electronics" <?php if($page == 'Electronics'){ ?> selected <?php } ?>>Electronics</option>
                                            <option value="NA" <?php if($page == 'NA'){ ?> selected <?php } ?>>NA</option>
                                            <option value="Others" <?php if($page == 'Others'){ ?> selected <?php } ?>>Others</option>
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

            function getTypeOfLoan(loan_type)
            {
                $("#hid_page_type").val(loan_type);
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
                        url: "load_report_loan_type.php?",
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