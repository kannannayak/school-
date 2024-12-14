<?php
include('include/header.php');
include('include/config.php');

// Check if edit parameter is set and is numeric
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $tourn_id = $_GET['edit'];
    
    // Prepare and execute the SQL query using prepared statements
    $stmt = $con->prepare("SELECT * FROM `tournament` WHERE tourn_id=?");
    $stmt->bind_param("i", $tourn_id);
    $stmt->execute();
    $res = $stmt->get_result();
    
    // Check if any row is returned
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $tourn_type = htmlspecialchars(trim($row['tourn_type']));
        $game_type = htmlspecialchars(trim($row['game_type']));
        $tourn_name = htmlspecialchars(trim($row['tourn_name']));
        $tourn_date = htmlspecialchars(trim($row['tourn_date']));
        $tourn_details = htmlspecialchars(trim($row['tourn_details']));
        $tourn_url = htmlspecialchars(trim($row['tourn_url']));
        $tourn_desc = $row['tourn_desc'];
        $tourn_image = htmlspecialchars(trim($row['tourn_image']));
    } else {
        echo "No record found.";
        exit; // Stop execution if no record found
    }
} else {
    echo "Invalid request.";
    exit; // Stop execution if edit parameter is missing or invalid
}
?>
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded mx-0">
        <div class="col-md-12">
            <div class="row my-2">
                <div class="col-md-10">
                    <h3>Edit Tournament</h3>
                </div>
                <div class="col-md-2">
                    <a href="table_tournament" class="btn btn-primary">Back</a>
                </div>
            </div>
            <form action="actions/post_tour_edit.php" method="post" enctype="multipart/form-data" id="productForm">
                <input type="hidden" name="edit" value="<?= $tourn_id ?>">
                
                <div class="form-group">
                    <label for="tourn_type">Tournament Type</label>
                    <input type="text" name="tourn_type" class="form-control" value="<?= $tourn_type ?>" id="tourn_type">
                    <span class="error" style="color:red;" id="type_error"></span>
                </div>

                <label for="game_type">Game Type</label>
                <select name="game_type" class="form-control" id="game_type">
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM game_type_web");
                    while ($state_row = mysqli_fetch_array($result)) {
                        echo "<option value='" . $state_row['game_type_id'] . "'";
                        if ($state_row['game_type_id'] == $row['game_type']) {
                            echo " selected";
                        }
                        echo ">" . htmlspecialchars($state_row['game_type_name']) . "</option>";
                    }
                    ?>
                </select>

                <div class="form-group">
                    <label for="tourn_name">Tournament Name</label>
                    <input type="text" name="tourn_name" class="form-control" value="<?= $tourn_name ?>" id="tourn_name">
                    <span class="error" style="color:red;" id="name_error"></span>
                </div>
                
                <div class="form-group">
                    <label for="tourn_image">Image</label>
                    <input type="file" name="tourn_image" class="form-control" id="tourn_image">
                </div>

                <div class="form-group">
                    <label for="tourn_date">Tournament Date</label>
                    <input type="text" name="tourn_date" class="form-control" value="<?= $tourn_date ?>" id="tourn_date" placeholder="dd-mm-yyyy">
                    <span class="error" style="color:red;" id="date_error"></span>
                </div>

                <div class="form-group">
                    <label for="tourn_details">Tournament Venue</label>
                    <input type="text" name="tourn_details" class="form-control" value="<?= $tourn_details ?>" id="tourn_details">
                    <span class="error" style="color:red;" id="details_error"></span>
                </div>

                <div class="form-group">
                    <label for="tourn_url">Tournament URL</label>
                    <input type="text" name="tourn_url" class="form-control" value="<?= $tourn_url ?>" id="tourn_url">
                    <span class="error" style="color:red;" id="url_error"></span>
                </div>

                <div class="form-group">
                    <h4 class="text-center">Tournament Description</h4>
                      <!--<textarea type="text" id="textareaMax" class="form-control" rows="14" placeholder="Enter your Description..." maxlength="1000" name="tourn_desc" value="<?php echo $row['tourn_desc']; ?>"><?php echo $row['tourn_desc']; ?></textarea>-->
                       <textarea type="text" id="textareaMax" class="form-control"  placeholder="Enter your Description..." maxlength="1000" name="tourn_desc" value="<?= $tourn_desc ?>"><?= $tourn_desc ?></textarea>
                </div>

                <br>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <br>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<script>
    function validateForm() {
        var isValid = true;
        var tourn_type = $.trim($("#tourn_type").val());
        var game_type = $.trim($("#game_type").val());
        var tourn_name = $.trim($("#tourn_name").val());
        var tourn_date = $.trim($("#tourn_date").val());
        var tourn_details = $.trim($("#tourn_details").val());
        var tourn_url = $.trim($("#tourn_url").val());

        $(".error").text("");
        if (tourn_type === "") {
            isValid = false;
            $("#type_error").text("Please enter a type");
        }
        if (game_type === "") {
            isValid = false;
            $("#game_error").text("Please enter a type");
        }
        if (tourn_name === "") {
            isValid = false;
            $("#name_error").text("Please enter a name.");
        }
        if (tourn_date === "") {
            isValid = false;
            $("#date_error").text("Please enter date.");
        }
        if (tourn_details === "") {
            isValid = false;
            $("#details_error").text("Please enter Venue.");
        }
        if (tourn_url === "") {
            isValid = false;
            $("#url_error").text("Please enter URL.");
        }
        return isValid;
    }

    $(document).ready(function () {
    
        
        $("#tourn_type").on("keyup", validateForm);
        $("#game_type").on("keyup", validateForm);
        $("#tourn_name").on("keyup", validateForm);
        $("#tourn_date").on("keyup", validateForm);
        $("#tourn_details").on("keyup", validateForm);
        $("#tourn_url").on("keyup", validateForm);

        $("#productForm").submit(function (e) {
            if (!validateForm()) {
                e.preventDefault();
            }
        });
    });
</script>
<script>
    // CKEDITOR.replace('tourn_desc');
    
CKEDITOR.replace('tourn_desc');
</script>
<?php include('include/footer.php'); ?>
