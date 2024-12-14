<?php include('include/header.php');
include('include/config.php');
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded mx-0">
        <div class="col-md-6 ">
            <h3>Change Password</h3>
            <?php if (isset($message)) { ?>
                <div class="success-message"><?php echo $message; ?></div>
            <?php } ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="old_pass">Enter Your Old Password</label>
                    <input type="password" class="form-control" name="old_pass" id="old_pass" required>
                </div>

                <div class="form-group">
                    <label for="new_pass">Enter Your New Password</label>
                    <input type="password" class="form-control" name="new_pass" id="new_pass" required>
                </div>

                <div class="form-group">
                    <label for="confirm_pass">Confirm New Password</label>
                    <input type="password" class="form-control" name="confirm_pass" id="confirm_pass" required>
                </div>

                <input type="submit" class="btn btn-primary" value="Change Password">
            </form>
        </div>
    </div>
</div>
<!-- Blank End -->
<?php include('include/footer.php'); ?>

<?php

// Check if admin ID is stored in the session
if (!isset($_SESSION['admin_id'])) {
    // Admin ID is not set, redirect to login page or handle accordingly
    header("Location: login.php"); // Replace "login.php" with your actual login page
    exit();
}

// Retrieve the admin ID from the session
$adminID = $_SESSION['admin_id'];

// Database conection and password change logic
include("include/config.php");

if (isset($_POST['old_pass']) && isset($_POST['new_pass']) && isset($_POST['confirm_pass'])) {
    $oldPassword = $_POST['old_pass'];
    $newPassword = $_POST['new_pass'];
    $confirmPassword = $_POST['confirm_pass'];

    // Query the database to retrieve the current admin password
    $query = "SELECT * FROM tbl_mst_admin_login WHERE Admin_ID = '$adminID'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    // Verify if the old password matches the one stored in the database
    if ($row['Admin_Pwd'] === $oldPassword) {
        // Check if the new password and confirm password match
        if ($newPassword === $confirmPassword) {
            // Update the admin password
            $updateQuery = "UPDATE tbl_mst_admin_login SET Admin_Pwd = '$newPassword', Admin_CPwd = '$newPassword' WHERE Admin_ID = '$adminID'";
            mysqli_query($con, $updateQuery);

            // Display success message or handle accordingly
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Password Changed!',
                        text: 'Your password has been changed successfully.',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href ='index.php';
                    });
                </script>";
        } else {
            // Passwords don't match, show an error message
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Password Mismatch',
                        text: 'New password and confirm password do not match.',
                    });
                </script>";
        }
    } else {
        // Old password is incorrect, show an error message
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Incorrect Password',
                    text: 'The old password is incorrect.',
                });
            </script>";
    }
}
?>