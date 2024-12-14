<?php include("include/head.php"); ?>
<style>
    .headflex{
         display: flex;
         justify-content: center; 
    }
    #msges{
        margin-top:50px;
    }
    .headcolor{
    color :#FB7D26;
    font-weight : 500;
    font-size :40px !important;
}
</style>


        <div class="row" id="msges" >
            <div class="col-lg-12">
                <div class="page-title">
                    <div class="headflex">
                        <!-- <h1>Dashboard-->
                        <!--<small>Content Overview</small>-->
                    </h1>
                    <h1 class="headcolor">The Mithraa Sports</h1>
                    <!-- <small class = "shri">Powered by Sri Annai Travels </small> -->
                    </div>
                   
                    
                    <ol class="breadcrumb">
                        <li class="active" style="color: black; "><i class="fa fa-dashboard"></i> Dashboard / Choose Dashboard</li>
                        <li class="pull-right">
                            <div id="reportrange" class="btn btn-green btn-square date-picker">
                                <i class="fa fa-calendar"></i>
                                <span class="date-range"></span> <i class="fa fa-caret-down"></i>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
            
        </div>

       
        <div class="row col-lg-12 " style="margin-top: 20px;" >

            <div class="col-lg-6">
                <div class="circle-tile " >
                    <a href="index.php">
                        <div class="circle-tile-heading dark-blue"  style="padding-top:15px;">
                      <i class="fa-solid fa-users  fa-3x"></i>
                        </div>
                    </a>                                                    
                    <div class="circle-tile-content dark-blue">
                        <div class="circle-tile-description text-faded">
                           Super Admin
                        </div>
                        <div class="circle-tile-number text-faded">
                            // <?php
                            //     echo $Totalstudents_rowCount;
                            // ?> 
                            <span id="sparklineA"></span>
                        </div>
                        <a href="index.php" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="circle-tile">
                    <a href="https://themithraa.com/Superadmin/website/index.php">
                        <div class="circle-tile-heading dark-blue" style="padding-top:15px;">
                            <i class="fa-solid fa-user-tie fa-3x"></i>
                        </div>
                    </a>
                    <div class="circle-tile-content dark-blue">
                        <div class="circle-tile-description text-faded">
                           Website Admin
                        </div>
                        <div class="circle-tile-number text-faded">
                            // <?php
                            // echo $Totaltrainers_rowCount;
                            // ?> 
                        </div>
                        <a href="https://themithraa.com/Superadmin/website/index.php" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>
            
      