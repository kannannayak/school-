
<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['tlog_id'])) {
    header("Location: login.php");
    exit;
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Select2 CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />  
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">

    <title>Mithraa sports</title>
</head>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<style>
   @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');


   
   

   
   body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    background: #fff;
    /* background-image: url("https://codzsword.github.io/bootstrap-sidebar/background-image.jpg");
    background-repeat: no-repeat;
    background-position: center bottom;
    background-size: cover; */
}

h3 {
    font-size: 1.2375rem;
    color: #FFF;
}

a {
    cursor: pointer;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
}

    
i {
    
    margin-right:25px;
}


.wrapper {
    align-items: stretch;
    display: flex;
    width: 100%;
}

#sidebar {
    max-width: 264px;
    min-width: 264px;
    height:925px;
    transition: all 0.35s ease-in-out;
    box-shadow: 0 0 35px 0 rgba(49, 57, 66, 0.5);
    z-index: 1111;
    background: linear-gradient( to bottom, #102B6E, #0191D6);
}

/* Sidebar collapse */

#sidebar.collapsed {
    margin-left: -264px;
}

.main {
    display: flex;
    flex-direction: column;
    min-height: auto;
    width: 100%;
    overflow: hidden;
    transition: all 0.35s ease-in-out;
}

.sidebar-logo {
    padding: 1.10rem 1.10rem;
    /* width: 500px; */
}

.sidebar-logo a {
    color: #e9ecef;
    font-size: 1.25rem;
    font-weight: 600;
}

.sidebar-nav {
    padding: 0;
    
}

.sidebar-header {
    color: #e9ecef;
    font-size: .75rem;
    padding: 1.5rem 1.5rem .375rem;
}

a.sidebar-link {
    padding: .925rem 1.625rem;
    color: #e9ecef;
    position: relative;
    display: block;
    font-size: 1rem;
}


/* Base styles for the notification link */
#notifyLink {
    position: relative;
    display: inline-block; 
    text-decoration: none;
    color: #000;
}


.badge-dot {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background-color: #dc3545;  
    color: white;
    font-size: 12px;
    font-weight: bold;
    text-align: center;
    line-height: 18px;
    position: absolute;
    top: -5px;
    right: -5px;
    display: none;  
}




.sidebar-link[data-bs-toggle="collapse"]::after {
    border: solid;
    border-width: 0 .075rem .075rem 0;
    content: "";
    display: inline-block;
    padding: 2px;
    position: absolute;
    right: 1.5rem;
    top: 1.4rem;
    transform: rotate(-135deg);
    transition: all .2s ease-out;
}

.sidebar-link[data-bs-toggle="collapse"].collapsed::after {
    transform: rotate(45deg);
    transition: all .2s ease-out;
}
.sidebar-nav:hover{
    list-style: none;
    
}
.content {
    flex: 1;
    max-width: 100vw;
   
    width: 100vw;

}
/* .circle {
        width: 100px;
        height: 100px;
        border: 2px solid blue; 
        border-radius: 50%; 
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden; 
      
    }

    .profile-image {
        width: 70px; 
        height: auto;
        border-radius: 50%;
       
    } */
.bodyclr{
    background:#E6F4FB !important;
}
sidebar-nav{
    background:red;
}
.nva-bg{
    background: linear-gradient( to bottom, #102B6E, #0191D6) !important; 
}

@media (min-width:768px) {
     .content {
        width: auto;
    } 
} 
.sidebar-link {
    text-decoration: none !important; 
}
.trainerid{
    text-decoration: none !important; 
    font-size: 20px !important;
}

.profile-image {
        border-radius: 50%; 
        overflow: hidden; 
        width: 130px; 
        height: 130px;
        margin-left:30px;
    }
#notification-count{
color:white;
 top: 10px;
            right: 10px;
}

    .modal-header{
        background:#E6F4FB !important; 
      color: #102B6E !important;
    }
    .modal-body  {
        background:#E6F4FB !important;
    }
    .custom-card {
        padding:10px;
        
    }
    .justify-text {
        text-align: justify;
        font-size:20px;
    }


    @media (max-width: 767px) {
        .modal-body p {
            font-size: 15px;

        }
    }
  .notification-dot {
    height: 10px;
    width: 10px;
    background-color: red;
    border-radius: 50%;
    display: inline-block;
    position: absolute;
    top: 10px; /* Adjust as needed */
    right: 10px; /* Adjust as needed */
}

    </style>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    
                <div class="circle">
        
                <img src="<?php echo $_SESSION['trainer_img']; ?>" class="profile-image" alt="Profile Image"> 

           
                </div>
                <br>
                    <h5 style="color:white; margin-left:15px"><?php echo $_SESSION['trainer_name']; ?></h5>
                    <a href="#" class="no-underline trainerid"> ID: <?php echo $_SESSION['tlog_id'] ?></a>
                </div>
                <!-- Sidebar Navigation -->
                <ul class="sidebar-nav">
                   
                    <li class="sidebar-item">
                        <a href="profile.php" class="sidebar-link">
                        <i class="fa-solid fa-user"></i>
                            Profile
                        </a>
                    </li>
                   
                    <li class="sidebar-item">
                        <a href="student_list.php" class="sidebar-link">
                        <i class="fa-solid fa-users"></i>
                            Students 
                        </a>
                    </li>
                     <li class="sidebar-item">
                        <a href="student.php" class="sidebar-link">
                        <i class="fa-solid fa-medal"></i>
                           Records
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="reports.php" class="sidebar-link">
                        <i class="fa-solid fa-chart-simple"></i>
                            History
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="notify.php" class="sidebar-link">
                          <i class="fa-solid fa-message"></i>
                            Notify
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="notification_list.php" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Notify List
                        </a>
                    </li>
                    <!-- <li class="sidebar-item">-->
                    <!--    <a href="school_notification_list.php" class="sidebar-link">-->
                    <!--       <i class="fa-brands fa-rocketchat"></i>-->
                    <!--        School Notification-->
                    <!--    </a>-->
                    <!--</li>-->
                    <li class="sidebar-item" id="notification-item">
    <a href="school_notification_list.php" class="sidebar-link">
        <i class="fa-brands fa-rocketchat"></i>
        School Notification
    </a>
</li>

                  
                    <li class="sidebar-item">
                        <a href="logout.php" class="sidebar-link">
                        <i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </a>
                    </li>
                   
                </ul>
            </div>
        </aside>
        <!-- Main Component -->
        
        <div class="main">
            
        <nav class="navbar navbar-expand navbar-dark px-3 border-bottom nva-bg">

<!-- Left-aligned content -->
<div class="d-flex align-items-center mr-auto">
    <button class="btn" type="button" data-bs-theme="dark">
        <span class="navbar-toggler-icon"></span>
    </button>
</div>

<!-- Right-aligned content -->
<!-- <div class="d-flex align-items-center">
    <a class="nav-link" href="#">
    <i class="fa-solid fa-bell fa-xl" id="notify" style="color: #fff;"></i>
    </a>
</div> -->
<!--<div class="d-flex align-items-center">-->
<!--    <a class="nav-link" href="#" id="notifyLink">-->
<!--        <i class="fa-solid fa-bell fa-xl" id="notifyIcon" style="color: #fff;"></i>-->
<!--        <span id="notification-count" class="badge-dot"></span>-->
<!--    </a>-->
<!--</div>-->

<!--<div class="modal" id="notificationModal">-->
<!--    <div class="modal-dialog modal-dialog-centered modal-lg">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <h5 class="modal-title">Notification</h5>-->
<!--                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>-->
<!--            </div>-->
<!--            <div class="modal-body custom-modal-body">-->
<!--                <div id="notification-list"></div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


<div class="d-flex align-items-center">
    <a class="nav-link" href="#" id="notifyLink">
        <i class="fa-solid fa-bell fa-xl" id="notifyIcon" style="color: #fff;"></i>
        <span id="notification-count" class="badge-dot"></span>
    </a>
</div>

<div class="modal" id="notificationModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body custom-modal-body">
                <div id="notification-list"></div>
            </div>
        </div>
    </div>
</div>




<script>
$(document).ready(function() {
    function fetchNotifications() {
        console.log("Fetching notifications...");
        $.ajax({
            url: 'fetch_trainer_notifications.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log("Data received: ", data);
                var notificationList = $('#notification-list');
                notificationList.empty();
                var newNotifications = 0;
                var ids = [];
                if (data.length > 0) {
                    $.each(data, function(index, notification) {
                        ids.push(notification.tri_notifi_id);
                        notificationList.append(
                            '<div class="card custom-card" data-id="' + notification.tri_notifi_id + '">' +
                            '<div class="row">' +
                            '<div class="col-md-8">' +
                            '<p class="justify-text">' + notification.msg_for_trainer + '</p>' +
                            '</div>' +
                            '<div class="col-md-4">' +
                            '<p><b>' + notification.msg_sent_time + '</b></p>' +
                            '</div>' +
                            '</div>' +
                            '</div>'
                        );
                        if (notification.is_read == 0) {
                            newNotifications++;
                        }
                    });
                    // Show badge only if there are new notifications
                    if (newNotifications > 0) {
                        $('#notification-count').show().text(newNotifications);
                    } else {
                        $('#notification-count').hide();
                    }
                } else {
                    $('#notification-count').hide();
                    notificationList.append('<div>No new notifications</div>');
                }
            },
            error: function(xhr, status, error) {
                console.error("Error fetching notifications: ", status, error);
            }
        });
    }

    function markNotificationsAsRead(ids) {
        console.log("Marking notifications as read: ", ids);
        $.ajax({
            url: 'mark_trainer_notifications_read.php',
            method: 'POST',
            data: { notification_ids: ids },
            dataType: 'json',
            success: function(response) {
                console.log("Mark as read response: ", response);
                if (response.status === 'success') {
                    fetchNotifications();  // Refresh the notification list and count after marking as read
                }
            },
            error: function(xhr, status, error) {
                console.error("Error marking notifications as read: ", status, error);
            }
        });
    }

    $('#notifyLink').click(function() {
        console.log("Notification icon clicked");
        fetchNotifications();  // Fetch notifications when the icon is clicked
        $('#notificationModal').modal('show');
    });

    $('#notificationModal').on('shown.bs.modal', function() {
        // When the modal is shown, mark notifications as read
        var notificationList = $('#notification-list');
        var ids = [];
        notificationList.find('.custom-card').each(function() {
            var id = $(this).data('id');
            if (id) {
                ids.push(id);
            }
        });
        if (ids.length > 0) {
            markNotificationsAsRead(ids);
        }
    });

    // Initial count fetch to display badge count on page load
    fetchNotifications();
});





</script>



</nav>



            

            


