<?php include("include/header.php"); ?>
<?php
//total earn
// $TotalEarn = "SELECT `total_amount` FROM `order`";
// $TotalEarn_result = mysqli_query($conn, $TotalEarn);
// //today earn

$date = date('d');
$month = date('m');
$year = date('Y');

// $TodayDate =$year.'-' .$month.'-'.$date;
// $TodayDate = date("Y-m-d");

$Totalstudents_query = "SELECT COUNT(*) AS total_students FROM `users`";
$Totalstudents_result = mysqli_query($conn, $Totalstudents_query);
$Totalstudents_row = mysqli_fetch_assoc($Totalstudents_result);
$Totalstudents_rowCount = $Totalstudents_row['total_students'];

$Totaltrainers_query = "SELECT COUNT(*) AS total_trainers FROM `trainer` WHERE trainer_status = 1";
$Totaltrainers_result = mysqli_query($conn, $Totaltrainers_query);
$Totaltrainers_row = mysqli_fetch_assoc($Totaltrainers_result);
$Totaltrainers_rowCount = $Totaltrainers_row['total_trainers'];

$Totalschools_query = "SELECT COUNT(*) AS total_schools FROM `school_list` WHERE school_status = 1";
$Totalschools_result = mysqli_query($conn, $Totalschools_query);
$Totalschools_row = mysqli_fetch_assoc($Totalschools_result);
$Totalschools_rowCount = $Totalschools_row['total_schools'];


$Totalnotification_query = "SELECT COUNT(*) AS total_notification FROM `notification` ";
$Totalnotification_result = mysqli_query($conn, $Totalnotification_query);
$Totalnotification_row = mysqli_fetch_assoc($Totalnotification_result);
$Totalnotification_rowCount = $Totalnotification_row['total_notification'];

$Total_isda_records_query = "SELECT COUNT(*) AS total_records FROM `isda_records` ";
$Total_isda_records_result = mysqli_query($conn, $Total_isda_records_query);
$Total_isda_records_row = mysqli_fetch_assoc($Total_isda_records_result);
$Total_isda_records_rowCount = $Total_isda_records_row['total_records'];


$Total_game_query = "SELECT COUNT(*) AS total_games FROM `game_type_web` ";
$Total_game_result = mysqli_query($conn, $Total_game_query);
$Total_game_row = mysqli_fetch_assoc($Total_game_result);
$Total_game_rowCount = $Total_game_row['total_games'];

$Total_notifi_query = "SELECT COUNT(*) AS sent_notifi FROM `trainer_notification` ";
$Total_notifi_result = mysqli_query($conn, $Total_notifi_query);
$Total_notifi_row = mysqli_fetch_assoc($Total_notifi_result);
$Total_notifi_rowCount = $Total_notifi_row['sent_notifi'];

$Total_slider_query = "SELECT COUNT(*) AS slider_img FROM `images` ";
$Total_slider_result = mysqli_query($conn, $Total_slider_query);
$Total_slider_row = mysqli_fetch_assoc($Total_slider_result);
$Total_slider_rowCount = $Total_slider_row['slider_img'];

?>


<style>
#page-wrapper {
    margin: 50px 0 0 225px;
    padding: 0 30px;
    min-height: 0 !important;
    height: auto;
    border-left: 1px solid #2c3e50;
    /* background-color : #084272; */
}
.iconmargin{
    margin-top:15px;
}
.headflex{
    display :flex;
    justify-content: center;
}
/*.btng{*/
/*    display :flex;*/
/*    justify-content:start;*/
/*}*/
.headcolor{
    color :#FB7D26;
    font-weight : 500;
    font-size :40px !important;
}
.shri{
    margin-left : 15px;
    margin-top : 20px;
}

</style>

<div id="page-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                     <a class="" href="choosedashboard">  
                           <button class="btn btn-primary  btng"> <i class="fa-solid fa-house"></i> Home</button>
                        </a>
                   
                    <div class="headflex">
                        <!-- <h1>Dashboard-->
                        <!--<small>Content Overview</small>-->
                       
                    </h1>
                    
                      

                    <h1 class="headcolor">The Mithraa Sports</h1>
                    <!-- <small class = "shri">Powered by Sri Annai Travels </small> -->
                    </div>
                   
                    
                    <ol class="breadcrumb">
                        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
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

       
        <div class="row col-lg-12 " style="margin-top: 10px;" >

            <div class="col-lg-4 ">
                <div class="circle-tile " >
                    <a href="student_list.php">
                        <div class="circle-tile-heading dark-blue" >
                        <i class="fa fa-id-card fa-fw fa-3x "></i>
                        </div>
                    </a>                                                    
                    <div class="circle-tile-content dark-blue">
                        <div class="circle-tile-description text-faded">
                           Students
                        </div>
                        <div class="circle-tile-number text-faded">
                            <?php
                                echo $Totalstudents_rowCount;
                            ?> 
                            <span id="sparklineA"></span>
                        </div>
                        <a href="student_list.php" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 ">
                <div class="circle-tile">
                    <a href="coaches_list.php">
                        <div class="circle-tile-heading dark-blue" style="padding-top:15px;">
                            <i class="fa-solid fa-user-group fa-fw  fa-3x"></i>
                        </div>
                    </a>
                    <div class="circle-tile-content dark-blue">
                        <div class="circle-tile-description text-faded">
                           Trainers
                        </div>
                        <div class="circle-tile-number text-faded">
                            <?php
                            echo $Totaltrainers_rowCount;
                            ?> 
                        </div>
                        <a href="coaches_list.php" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 ">
                <div class="circle-tile">
                    <a href="school.php">
                        <div class="circle-tile-heading dark-blue" style="padding-top:15px;" >
                        <i class="fa-solid fa-school fa-3x"></i>
                        </div>
                    </a>
                    <div class="circle-tile-content dark-blue">
                        <div class="circle-tile-description text-faded">
                           Schools
                        </div>
                        <div class="circle-tile-number text-faded">
                             <?php
                                echo $Totaltrainers_rowCount;
                            ?> 
                        </div>
                        <a href="school.php" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 ">
                <div class="circle-tile">
                    <a href="groups.php">
                        <div class="circle-tile-heading dark-blue">
                        <i class="fa fa-users-rectangle fa-fw fa-3x"></i>
                        </div>
                    </a>
                    <div class="circle-tile-content dark-blue">
                        <div class="circle-tile-description text-faded">
                           Groups
                        </div>
                        <div class="circle-tile-number text-faded">
                             <?php
                                echo $Totalschools_rowCount;
                            ?> 
                        </div>
                        <a href="groups.php" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>

          

            <div class="col-lg-4 ">
                <div class="circle-tile">
                    <a href="notification.php">
                        <div class="circle-tile-heading dark-blue" style="padding-top:15px;">
                        <i class="fa-solid fa-bell fa-3x"></i>
                        </div>
                    </a>
                    <div class="circle-tile-content dark-blue">
                        <div class="circle-tile-description text-faded">
                          Trainer Notification
                        </div>
                        <div class="circle-tile-number text-faded">
                             <?php
                                echo $Totalnotification_rowCount;
                            ?> 
                        </div>
                        <a href="notification.php" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 ">
                <div class="circle-tile">
                    <a href="notifi.php">
                        <div class="circle-tile-heading dark-blue" style="padding-top:17px;">
                        <i class="fa-solid fa-message fa-3x"></i>
                        </div>
                    </a>
                    <div class="circle-tile-content dark-blue">
                        <div class="circle-tile-description text-faded">
                          Admin Notification
                        </div>
                        <div class="circle-tile-number text-faded">
                             <?php
                                echo "00";
                            ?> 
                        </div>
                        <a href="notifi.php" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>
           
              <div class="col-lg-4 ">
                <div class="circle-tile">
                    <a href="isda_record.php">
                        <div class="circle-tile-heading dark-blue" style="padding-top:17px;">
                       <i class="fa-solid fa-trophy fa-3x"></i>
                        </div>
                    </a>
                    <div class="circle-tile-content dark-blue">
                        <div class="circle-tile-description text-faded">
                         ISDA Records
                        </div>
                        <div class="circle-tile-number text-faded">
                             <?php
                               echo $Total_isda_records_rowCount;
                            ?> 
                        </div>
                        <a href="isda_record.php" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>

          
               <div class="col-lg-4 ">
                <div class="circle-tile">
                    <a href="games.php">
                        <div class="circle-tile-heading dark-blue" style="padding-top:17px;">

                       <i class="fa-solid fa-person-running fa-3x"></i>
                        </div>
                    </a>
                    <div class="circle-tile-content dark-blue">
                        <div class="circle-tile-description text-faded">
                        Games
                        </div>
                        <div class="circle-tile-number text-faded">
                             <?php
                               echo $Total_game_rowCount;
                            ?> 
                        </div>
                        <a href="games.php" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>
            
            
              <div class="col-lg-4 ">
                <div class="circle-tile">
                    <a href="sent_notification.php">
                        <div class="circle-tile-heading dark-blue" style="padding-top:17px;">

                       
                       <i class="fa-solid fa-comments fa-3x"></i>
                        </div>
                    </a>
                    <div class="circle-tile-content dark-blue">
                        <div class="circle-tile-description text-faded">
                       Sent Notification
                        </div>
                        <div class="circle-tile-number text-faded">
                             <?php
                               echo $Total_notifi_rowCount;
                            ?> 
                        </div>
                        <a href="sent_notification.php" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>
            
               <div class="col-lg-4 ">
                <div class="circle-tile">
                    <a href="slider_img.php">
                        <div class="circle-tile-heading dark-blue" style="padding-top:17px;">

                       
                     
                       <i class="fa-regular fa-image  fa-3x"></i>
                        </div>
                    </a>
                    <div class="circle-tile-content dark-blue">
                        <div class="circle-tile-description text-faded">
                       Sliders
                        </div>
                        <div class="circle-tile-number text-faded">
                             <?php
                               echo $Total_slider_rowCount;
                            ?> 
                        </div>
                        <a href="slider_img.php" class="circle-tile-footer">More Info <i class="fa fa-chevron-circle-right"></i></a>
                    </div>
                </div>
            </div>
      

            
           
        </div>

        
    </div>
   
</div>



<!-- end MAIN PAGE CONTENT -->
<?php 


include("include/footer.php"); ?>