<?php
include('include/header.php');
include('include/config.php');

// Check if edit parameter is set and is numeric
if(isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $id = $_GET['edit'];
    
    // Prepare and execute the SQL query using prepared statements
    $stmt = $con->prepare("SELECT * FROM `comments` WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    
    // Check if any row is returned
    if($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $id = htmlspecialchars($row['id']);
        $name = htmlspecialchars($row['name']);
        $email = htmlspecialchars($row['email']);
        $phone = htmlspecialchars($row['phone']);
        $comments = htmlspecialchars($row['comments']);
      
    } else {
        echo "No record found.";
        exit; // Stop execution if no record found
    }
} else {
    echo "Invalid request.";
    exit; // Stop execution if edit parameter is missing or invalid
}
?>

<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded mx-0">
        <div class="col-md-12">
            <div class="row my-2">
                <div class="col-md-10">
                    <h3>Comments</h3>
                </div>
                <div class="col-md-2">
                    <a href="comments" class="btn btn-primary">Back</a>
                </div>
                <form action="actions/post_edit_comments.php" method="post" enctype="multipart/form-data" id="productForm">
                    <input type="hidden" name="id" value="<?= $id ?>">
                   
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" value="<?= $name ?>" id="name">
                        <span class="error" style="color:red;" id="name_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" value="<?= $email ?>" id="email" required>
                        <span class="error" style="color:red;" id="email_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="<?= $phone ?>" id="phone" required>
                        <span class="error" style="color:red;" id="phone_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Inbox</label>
                        <input type="text" name="comments" class="form-control" value="<?= $comments ?>" id="comments" required>
                        <span class="error" style="color:red;" id="comments_error"></span>
                    </div>
                   

                    <!--<div class="form-group">-->
                    <!--    <button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button>-->
                    <!--</div>-->
                </form>
            </div>
        </div>
    </div><br>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function validateForm() {
        var isValid = true;
   
        var name = $.trim($("#name").val());
        var age = $.trim($("#age").val());
        var email = $.trim($("#email").val());
        var phone = $.trim($("#phone").val());
        var comments = $.trim($("#comments").val());
        

        $(".error").text("");
       
        if (name === "") {
            isValid = false;
            $("#name_error").text("Please enter a name.");
        }

        if (email === "") {
            isValid = false;
            $("#email_error").text("Please enter email.");
        }

        if (phone === "") {
            isValid = false;
            $("#phone_error").text("Please enter phone Number.");
        }

        if (comments === "") {
            isValid = false;
            $("#comments_error").text("Please enter comments.");
        }

      

        return isValid;
    }

    $(document).ready(function () {
        $("#name").on("keyup", validateForm);
        $("#email").on("keyup", validateForm);
        $("#phone").on("keyup", validateForm);
        $("#comments").on("keyup", validateForm);
        

        $("#productForm").submit(function (e) {
            if (!validateForm()) {
                e.preventDefault();
            }
        });
    });
</script>

<?php include('include/footer.php'); ?>
