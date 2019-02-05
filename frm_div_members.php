<?php
	if($fpo_id == "" && (!isset($_SESSION['sqyard_user'])) && $_SESSION['sqyard_user']=="")
	{
        ?>
        <script type="text/javascript">
            history.go(-1);
        </script>
        <?php
    }

    // echo $_REQUEST['fpo_id'];
    // get org_id
    $row_get_org_id = checkExist('tbl_change_agents', array('id'=>$_REQUEST['fpo_id']));
    $hid_org_id = $row_get_org_id['org_id'];
?>

    
            
                <div class="box-title">
                    <h3>
                        <i class="icon-table"></i>
                        Farmers
                    </h3>
                </div>
                <div class="box-content nopadding">
                    <div style="padding:10px 15px 10px 15px !important">
                        <input type="hidden" name="hid_user_type" id="hid_user_type" value="<?php echo $_SESSION['userType'] ?>">
                        <input type="hidden" name="hid_ca_id" id="hid_ca_id" value="<?php echo $ca_id; ?>">
                        <input type="hidden" name="hid_org_id" id="hid_org_id" value="<?php echo $hid_org_id; ?>">
                        <input type="hidden" name="hid_page" id="hid_page" value="1">
                        <input type="hidden" name="cat_parent" id="cat_parent" value="parent">
                        <select name="rowlimit" id="rowlimit" onChange="loadFarmerData();"  class = "select2-me">
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
                            <div id="container1" > <!-- class="data_container" -->
                            </div>
                        </div>
                    </div>
                </div>
            

<script type="text/javascript">
    $(document).ready(function(e) 
    {
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
    
    function loadFarmerData()
    {
        //loading_show();
        hid_user_type = $('#hid_user_type').val();   
        hid_ca_id     = $('#hid_ca_id').val();
        hid_org_id    = $('#hid_org_id').val();
        row_limit     = $.trim($('select[name="rowlimit"]').val());
        search_text   = $.trim($('#srch').val());
        page          = $.trim($("#hid_page").val());
        load_farmer   = "1";          
        if(row_limit == "" && page == "")
        {
            alert('Can not Get Row Limit and Page number');
            //loading_hide();
        }
        else
        {
            var sendInfo    = {"hid_org_id":hid_org_id,"row_limit":row_limit, "search_text":search_text, "load_farmer":load_farmer, "page":page, "hid_user_type":hid_user_type, "hid_ca_id":hid_ca_id};
            var farmer_load = JSON.stringify(sendInfo);             
            $.ajax({
                url: "load_fpo.php?",
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
</script>