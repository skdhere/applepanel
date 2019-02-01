<?php 
    include('config/autoload.php'); 
    include('access1.php'); 
    
    include('include/query-helper.php');
    
    $feature_name   = 'Dashboard';
    $home_name      = "Home";
    $title          = 'SqoreYard | Home';
    $home_url       = "home.php";
    $filename       = 'home.php';

    // echo $_SESSION['org_id'].'/'.$_SESSION['userType'];
    // 
    
    ?>
<!doctype html>
<html>

    <head>
        <?php
        /* This function used to call all header data like css files and links */
        headerdata($feature_name);
        /* This function used to call all header data like css files and links */
        ?>
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <style type="text/css">
            h2{
                font-size: 22.5px !important;
            }
            .text-right{
                text-align: center !important;
                padding-top:15px !important;
            }
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
                breadcrumbs($home_url,$home_name,'Dashboard',$filename,$feature_name);
                /* this function used to add navigation menu to the page*/
                ?>
                <div class="container-fluid">
                    <div class="span12">
                        <div class="box box-bordered box-color" >
                            <div class="box-title">
                                <h3><i class="icon-dashboard"></i>Basic Counts</h3>
                            </div>
                            <div style="clear:both">&nbsp;</div>
                            <div class="container">
                                
                                <div class="row">
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"></div><br>
                                                        <div><h2>Registration Count</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>  <!-- Registration Count -->
                                    
                                    <div class="span4" >
                                        <div class="panel panel-green">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"><br>
                                                        <div><h2>Complete Farmers</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>  <!-- Complete Farmers -->

                                    <div class="span4" >
                                        <div class="panel panel-red">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"></div><br>
                                                        <div><h2>Uploading in process</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>  <!-- Incomplete Farmers -->

                                </div>  <!-- User Section --> 
                                
                                <div class="row">
                                    <div class="span6" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"></div><br>
                                                        <div><h2>Total Amount Of loan</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>  <!-- Total Amount Of loan -->
                                    
                                    <div class="span6" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"></div><br>
                                                        <div><h2>Farmer Count Who wants Loan</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>  <!-- Farmer Count Who wants Loan -->
                                </div>  <!-- Loan Section -->

                                <div class="row">
                                    
                                    <div class="span6" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"></div><br>
                                                        <div><h2>Smartphone Count</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>  <!-- Smart Phone Count -->
                                    
                                    <div class="span6" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"></div><br>
                                                        <div><h2>Featuredphone Count</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>  <!-- Featured Phone Count -->

                                </div>  <!-- Phone Type Section -->
                                
                            </div>
                        </div>
                    </div>
                </div>  <!-- Basic Counts -->
                
                <div class="container-fluid">
                    <div class="span12">
                        <div class="box box-bordered box-color" >
                            <div class="box-title">
                                <h3><i class="icon-dashboard"></i>Total Spend on Inputs (In Rs.)</h3>
                            </div>
                            <div style="clear:both">&nbsp;</div>
                            <div class="container">
                                
                                <div class="row">
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"></div><br>
                                                        <div><h2>Total Spend on Seeds</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  <!-- Total Spend on Seeds -->
                                    
                                    <div class="span4" >
                                        <div class="panel panel-green">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"></div><br>
                                                        <div><h2>Total Spend on Fertilisers</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  <!-- Total Spend on Fertilisers -->

                                    <div class="span4" >
                                        <div class="panel panel-red">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"></div><br>
                                                        <div><h2>Total Spend on Pesticide</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  <!-- Total Spend on Pesticide -->

                                </div>  <!-- Total Spend on Inputs: Seeds, Pesticide and Fertilisers --> 
                                
                            </div>
                        </div>
                    </div>
                </div>  <!-- Total Spend on Inputs -->

                <div class="container-fluid">
                    <div class="span12">
                        <div class="box box-bordered box-color" >
                            <div class="box-title">
                                <h3><i class="icon-dashboard"></i>Total Quantity (In Kg.)</h3>
                            </div>
                            <div style="clear:both">&nbsp;</div>
                            <div class="container">
                                
                                <div class="row">
                                    
                                    <div class="span4" >
                                        <div class="panel panel-cadetblue">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"></div><br>
                                                        <div><h2>Total Quantity of Seeds</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  <!-- Total Quantity of Seeds -->
                                    
                                    <div class="span4" >
                                        <div class="panel panel-green">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"></div><br>
                                                        <div><h2>Total Quantity of Fertilisers</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  <!-- Total Quantity of Fertilisers -->

                                    <div class="span4" >
                                        <div class="panel panel-red">
                                            <div class="panel-heading">
                                                <div class="row" style="padding-left: 30px;">
                                                    <div class="col-xs-3">
                                                        <!--<i class="fa fa-users fa-5x"></i>-->
                                                    </div>
                                                    <div class="col-xs-9 text-right">
                                                        <div class="huge"></div><br>
                                                        <div><h2>Total Quantity of Pesticide</h2></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  <!-- Total Quantity of Pesticide -->

                                </div>  <!-- Total Quantity of: Seeds, Pesticide and Fertilisers --> 
                                
                            </div>
                        </div>
                    </div>
                </div>  <!-- Total Spend on Inputs -->

                
            
            </div>
        </div>  
    </body>
</html>