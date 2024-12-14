<?php include("include/conn.php"); ?>
<?php
session_start();
if (isset($_SESSION['school_name']) || isset($_SESSION['school_name'])){
    
    // exit();
}else{
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Mithra Sports</title>
    <!-- PACE LOAD BAR PLUGIN - This creates the subtle load bar effect at the top of the page. -->
    <!-- <link href="css/plugins/pace/pace.css" rel="stylesheet"> -->
    <!-- <script src="js/plugins/pace/pace.js"></script> -->
    <!-- GLOBAL STYLES - Include these on every page. -->
    <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic'
        rel="stylesheet" type="text/css">
    <link
        href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
        rel="stylesheet" type="text/css">
    <link href="icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/website/css/uicons-outline-rounded.css" rel="stylesheet">
    <!-- PAGE LEVEL PLUGIN STYLES -->
    <!-- <link href="css/plugins/messenger/messenger.css" rel="stylesheet"> -->
    <!-- <link href="css/plugins/messenger/messenger-theme-flat.css" rel="stylesheet"> -->
    <!-- <link href="css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet"> -->
    <!-- <link href="css/plugins/morris/morris.css" rel="stylesheet"> -->
    <!-- <link href="css/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"> -->
    <link href="css/plugins/datatables/datatables.css" rel="stylesheet">
    <!-- <------------fav icon------>
    <link rel="icon" type="image/png" href=".assets/images/icons/admin1.png">
    <!-- THEME STYLES - Include these on every page. -->
    <link href="css/flex-admin.css" rel="stylesheet">
    <link href="css/plugins.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- THEME DEMO STYLES - Use these styles for reference if needed. Otherwise they can be deleted. -->
    <link href="css/demo.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>


    <!-- data table  -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <!-- sweet alert  -->
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="css/w3.css" rel="stylesheet">
    <style>
        .daterangepicker td.active,
        .daterangepicker td.active:hover {
            background-color: #16a085;
            border-color: #16a085;
            color: #fff;
        }

        .daterangepicker .ranges li.active,
        .daterangepicker .ranges li:hover {
            background: #16a085;
            border: 1px solid #16a085;
            color: #fff;
        }

        .daterangepicker .ranges li {
            color: #16a085;
        }
        .im{
            margin-right: 8px;
        }
        #colourheader{
            background-color: #121C5F ;
        }
        #sidecolor{
            background: linear-gradient( to bottom, #102B6E, #0191D6) !important;
        }
        /* body{
            background: linear-gradient( to bottom, #102B6E, #0191D6) !important;
        } */
    </style>
    <!-- at the modal page of the buy page product details -->



</head>

<body>
    <div id="wrapper">
        <!-- begin TOP NAVIGATION -->
        <nav class="navbar-top" role="navigation" id = "colourheader">
            <!-- begin BRAND HEADING -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle pull-right" data-toggle="collapse"
                    data-target=".sidebar-collapse">
                    <i class="fa fa-bars"></i> Menu
                </button>
                <div class="navbar-brand">
                    <a href="index">
                        <b style="color:white;">School Admin Panel</b>
                    </a>
                </div>
            </div>
            <!-- end BRAND HEADING -->
            <div class="nav-top">
                <!-- begin LEFT SIDE WIDGETS -->
                <ul class="nav navbar-left">
                    <li class="tooltip-sidebar-toggle">
                        <a href="#" id="sidebar-toggle" data-toggle="tooltip" data-placement="right"
                            title="Sidebar Toggle">
                            <i class="fa fa-bars"></i>
                        </a>
                    </li>
                    <!-- You may add more widgets here using <li> -->
                </ul>
                <!-- end LEFT SIDE WIDGETS -->
                <!-- begin MESSAGES/ALERTS/TASKS/USER ACTIONS DROPDOWNS -->
                <ul class="nav navbar-right">
                    <!-- begin USER ACTIONS DROPDOWN -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a class="logout_open" href="logout">
                                    <i class="fa fa-sign-out"></i> Logout
                                    <strong>Admin </strong>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-menu -->
                    </li>
                </ul>
                <!-- /.nav -->
                <!-- end MESSAGES/ALERTS/TASKS/USER ACTIONS DROPDOWNS -->
            </div>
            <!-- /.nav-top -->
        </nav>
        <!-- /.navbar-top -->
        <!-- end TOP NAVIGATION -->
        <!-- begin SIDE NAVIGATION -->
        
 
        <nav class="navbar-side" role="navigation" >
            <div class="navbar-collapse sidebar-collapse collapse"  id ="sidecolor">
               
            
                <ul  class="nav navbar-nav side-nav"  id ="sidecolor" >
                    <!-- begin SIDE NAV USER PANEL -->
                    <li class="side-user hidden-xs" >
                        <img class="img-circle" src="img/profile-pic.png" alt="">
                        <p class="welcome">
                            <!-- <i class="fa fa-key"></i> Logged in as -->
                        </p>
                        <p class="name tooltip-sidebar-logout">
                            <?php echo $_SESSION['school_name'] ?>  <span class="last-name"></span> <a
                                style="color: inherit" class="logout_open" href="logout" data-toggle="tooltip"
                                data-placement="top" title="Logout"><i class="fa fa-sign-out"></i></a>
                               
                        </p>
                        <div class="clearfix"></div>
                    </li>
                                     
                    <li class="">   
                        <a class="" href="index">  
                            <i class="fa fa-dashboard"> </i>Dashboard
                        </a>
                    </li>
                    <li class="">   
                        <a class="" href="student_list">  
                            <i class="fa-solid fa-users"></i> Students
                        </a>
                    </li>
                    <li class="">   
                        <a class="" href="coaches_list">  
                            <i class="fa-solid fa-user-group fa-fw"></i>Trainers
                        </a>
                    </li>
                  
                    <li class="">   
                        <a class="" href="groups">  
                           <i class="fa fa-users-rectangle fa-fw"></i> Groups
                        </a>
                    </li>
                      
                    <li class="">   
                        <a class="" href="notifi">  
                           <i class="fa-solid fa-message"> </i> Admin Notification
                        </a>
                    </li>
                   
                    <li class="">   
                        <a class="" href="notification">  
                           <i class="fa-solid fa-bell"> </i> Trainer Notification
                        </a>
                    </li>
                    <li class="">   
                        <a class="" href="reports">  
                           <i class="fa-solid fa-file-pen"> </i> Report
                        </a>
                    </li>
                   

                    </li>
                      <li class="">   
                        <a class="" href="sent_notification">  
                         <i class="fa-solid fa-comments"></i> Sent Notification
                        </a>
                    </li>
                     </li>
                      <li class="">   
                        <a class="" href="school_notification">  
                         <i class="fa-solid fa-comments"></i> Sent Notification
                        </a>
                    </li>
                   
                    <!-- <li class="">   
                        <a class="" href="changepassword">  
                            <i class="fa fa-key"></i>Change Password
                        </a>
                    </li> -->

                    <li class="">
                        <a class="" href="logout">
                            <i class="fa fa-sign-out"></i>Logout
                        </a>
                    </li>
                                    <!-- /.side-nav -->
                </ul>
                </div>
               
            </div>

            <!-- /.navbar-collapse -->
        </nav>

   
