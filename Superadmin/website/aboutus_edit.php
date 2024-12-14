<?php
include('include/header.php');
include('include/config.php');

if (isset($_GET['about_id']) && is_numeric($_GET['about_id'])) {
    $about_id = $_GET['about_id'];
    
    $stmt = $con->prepare("SELECT * FROM `about_us_number` WHERE about_id = ?");
    $stmt->bind_param("i", $about_id);
    $stmt->execute();
    $res = $stmt->get_result();
    
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $Students = htmlspecialchars($row['Students']);
        $Awards = htmlspecialchars($row['Awards']);
        $trainers = htmlspecialchars($row['trainers']);
    } else {
        echo "No record found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded mx-0">
        <div class="col-md-12">
            <div class="row my-2">
                <div class="col-md-10">
                    <h3>Edit Details</h3>
                </div>
                <div class="col-md-2">
                    <a href="aboutus_number.php" class="btn btn-primary">Back</a>
                </div>
            </div>
            <form action="actions/post_aboutus.php" method="post" enctype="multipart/form-data" id="productForm">
    <input type="hidden" name="about_id" value="<?= $about_id ?>">
    <div class="form-group">
        <label for="Students">Students</label>
        <input type="text" name="Students" class="form-control" value="<?= $Students ?>" id="Students" required>
        <span class="error" style="color:red;" id="Students_error"></span>
    </div>
    <div class="form-group">
        <label for="Awards">Awards</label>
        <input type="text" name="Awards" class="form-control" value="<?= $Awards ?>" id="Awards" required>
        <span class="error" style="color:red;" id="Awards_error"></span>
    </div>
    <div class="form-group">
        <label for="trainers">Trainers</label>
        <input type="text" name="trainers" class="form-control" value="<?= $trainers ?>" id="trainers" required>
        <span class="error" style="color:red;" id="trainers_error"></span>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button>
    </div>
</form>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function validateForm() {
    var isValid = true;
    
    var Awards = $.trim($("#Awards").val());
    var trainers = $.trim($("#trainers").val());
    var Students = $.trim($("#Students").val());

    $(".error").text("");
    
    if (Awards === "") {
        isValid = false;
        $("#Awards_error").text("Please enter Awards.");
    }

    if (trainers === "") {
        isValid = false;
        $("#trainers_error").text("Please enter trainers.");
    }

    if (Students === "") {
        isValid = false;
        $("#Students_error").text("Please enter Students.");
    }

    return isValid;
}

$(document).ready(function () {
    $("#Awards").on("keyup", validateForm);
    $("#trainers").on("keyup", validateForm);
    $("#Students").on("keyup", validateForm);

    $("#productForm").submit(function (e) {
        if (!validateForm()) {
            e.preventDefault();
        }
    });
});
</script>

<?php include('include/footer.php'); ?>
