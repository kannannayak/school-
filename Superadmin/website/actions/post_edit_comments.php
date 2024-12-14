<?php
// Include the necessary configuration file and any other required files
include('../include/config.php');

// Check if the form is submitted
if(isset($_POST['submit'])){
    // Retrieve data from the form
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $comments = $_POST['comments'];

    // Sanitize user input to prevent SQL injection
    $name = mysqli_real_escape_string($con, $name);
    $email = mysqli_real_escape_string($con, $email);
    $phone = mysqli_real_escape_string($con, $phone);
    $comments = mysqli_real_escape_string($con, $comments);

  
    $sql = "UPDATE `comments` SET `name`=?, `email`=? ,`phone`=?,`comments`=?  WHERE `id`=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email,$phone,$comments, $id);
    $res = $stmt->execute();
    
    
    // Check if the query was successful
    if($res){
        echo "<script>alert('Data updated successfully!');</script>";
        echo "<script>window.location.href ='../comments';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
?>

<!-- Your HTML form goes here -->

<?php include('include/footer.php'); ?>
