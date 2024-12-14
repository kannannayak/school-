<!DOCTYPE html>
<html lang="en">
// <!--<?php
// <!--session_start();-->
// <!--if (!isset($_SESSION['admin_name'])) {-->
// <!--    header("Location: login.php");-->
// <!--    exit;-->
// <!--}
// <!--?>

<head>
    <meta charset="utf-8">
    <title>Mithraa sports</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">


    <script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

</head>
<style>
    .sidebar .navbar .navbar-nav .nav-link {
        padding: 7px 11px !important;
      
    }
</style>

<body>
    
    <div class="overflow position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3"style="overflow-y: auto;overflow-x: hidden;">
            <nav class="navbar bg-light navbar-light">
                <a href="index" class="navbar-brand mx-4 mb-3">
                    <h4>Mithra sports</h4>
                </a>
                
                <div class="navbar-nav ">
                    <a href="index" class="nav-item nav-link"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                    <a href="about_us" class="nav-item nav-link"><i class="fa-solid fa-address-card"></i> About us</a>
                    <a href="sliders" class="nav-item nav-link"><i class="fa-solid fa-image"></i> Sliders</a>
                     <a href="franchise" class="nav-item nav-link"><i class="fa-solid fa-building"></i>  Franchise Request</a>
                    <!-- <a  href="changepassword?id=<?php echo $_SESSION['admin_id'] ?>"  class="nav-item nav-link"><i class="fa fa-cubes me-2"></i>Rules</a> -->
                    <a  href="privacy_policy"  class="nav-item nav-link"><i class="fa fa-cubes me-2"></i>Rules</a>
                    
                    
                    <a  href="toplist" class="nav-item nav-link"><i class="fa-solid fa-medal"></i> Top List</a>                    
                  
                   
                    <a href="table_tutorial" class="nav-item nav-link"><i class="fa fa-credit-card me-2"></i>Tutorials</a>
                    <a href="comments" class="nav-item nav-link"><i class="fa-solid fa-comment"></i> comments</a>

                    
           



                  <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-chess"></i></i> Tournament</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="table_tournament" class="dropdown-item"><i class="fa fa-angle-double-right me-4"></i>Create</a>
                            <a href="register_tour" class="dropdown-item"><i class="fa fa-angle-double-right me-4"></i>Register</a>
                        </div>
                    </div>


    <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-upload"></i> Gallery</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="table_img" class="dropdown-item"><i class="fa fa-angle-double-right me-4"></i>Images</a>
                            <a href="video_table" class="dropdown-item"><i class="fa fa-angle-double-right me-4"></i>Videos</a>
                        </div>
                    </div>


                         <a href="records.php" class="nav-item nav-link"><i class="fa-solid fa-list"></i> Records</a>
                       <a href="achievers.php" class="nav-item nav-link"><i class="fa-solid fa-trophy"></i> Achievers</a>
                     <a href="aboutus_number.php" class="nav-item nav-link"><i class="fa-solid fa-list"></i> Abouts Us Number</a>
                     <a href="sports_tacking.php" class="nav-item nav-link"><i class="fa-solid fa-icons"></i> Website Image</a>
                    <a href="table_news.php" class="nav-item nav-link"><i class="fa-regular fa-newspaper"></i > News</a>
                      <!--<a href="age_list.php" class="nav-item nav-link"><i class="fa-solid fa-bars"></i>  Age List</a>-->
                </div>
                
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-5"><i class="fa fa-hashtag"></i></h2>
                </a>
               
            </nav>
            <!-- Navbar End -->