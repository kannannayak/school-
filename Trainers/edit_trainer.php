<?php
// session_start();
include("include/header.php");
include("include/conn.php");
$image = $_SESSION['trainer_img'];
?>
<style>
.btn{
            background: linear-gradient( to bottom, #102B6E, #0191D6);
            color:#fff;
        }
        </style>
<div class="col-md-8 mx-auto mt-4">
    <h2>Edit Profile</h2>
    <!-- <img src="<?php echo $_SESSION['trainer_img']; ?>" class="profile-image" alt="Profile Image">  -->
    <br>
    <form action="action/post_trainer.php" method="POST" enctype="multipart/form-data">
        <input type="file" class="form-control"  name="trainer_img" > 
        <input type="hidden"class="form-control" name="old_image"  value="<?= $image ?>" > 
        <br>
        <input type="text" class="form-control" name="new_name" value="<?php echo $_SESSION['trainer_name']; ?>" placeholder="Enter new name">
        <br>
        <input type="submit" class="btn" name="update" value="Update">
    </form>
    
</div>

<?php
include("include/footer.php");
?>
