<?php
include('include/header.php');
include('include/config.php');

// Check if edit parameter is set and is numeric
if(isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $toper_id = $_GET['edit'];
    
    // Prepare and execute the SQL query using prepared statements
    $stmt = $con->prepare("SELECT * FROM `topers_list_web` WHERE toper_id=?");
    $stmt->bind_param("i", $toper_id);
    $stmt->execute();
    $res = $stmt->get_result();
    
    // Check if any row is returned
    if($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $game_id = htmlspecialchars($row['game_id']);
        $name = htmlspecialchars($row['name']);
        $age = htmlspecialchars($row['age']);
        $gender = htmlspecialchars($row['gender']);
        $time = htmlspecialchars($row['time']);
        // $athlete = htmlspecialchars($row['athlete']);
        $year = htmlspecialchars($row['year']);
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
                    <h3>Edit Details</h3>
                </div>
                <div class="col-md-2">
                    <a href="toplist" class="btn btn-primary">Back</a>
                </div>
                <form action="actions/post_toplist_edit.php" method="post" enctype="multipart/form-data" id="productForm">
                    <input type="hidden" name="id" value="<?= $toper_id ?>">
                    <div>
                        <label>Game type</label>
    <select name="game" class="form-control" id="game">
    <?php
        // $result = mysqli_query($con, "SELECT * FROM game_type_web");
        // while ($row = mysqli_fetch_array($result)) {
        //     echo "<option value='" . $row['game_type_id'] . "'>" . $row['game_type_name'] . "</option>";
        // }
        $result = mysqli_query($con, "SELECT * FROM game_type_web");
                while ($state_row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $state_row['game_type_id'] . "'";
                    if ($state_row['game_type_id'] == $row['game_id']) {
                        echo " selected";
                    }
                    echo ">" . $state_row['game_type_name'] . "</option>";
                }
        ?>
    </select>
    <span class="error" style="color:red;" id="game_error"></span>
</div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="<?= $name ?>" id="name">
                        <span class="error" style="color:red;" id="name_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="text" name="age" class="form-control" value="<?= $age ?>" id="age" required>
                        <span class="error" style="color:red;" id="age_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <input type="text" name="gender" class="form-control" value="<?= $gender ?>" id="gender" required>
                        <span class="error" style="color:red;" id="gender_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="time">Time</label>
                        <input type="text" name="time" class="form-control" value="<?= $time ?>" id="time" required>
                        <span class="error" style="color:red;" id="time_error"></span>
                    </div>
                    <!--<div class="form-group">-->
                    <!--    <label for="athlete">Athlete</label>-->
                    <!--    <input type="text" name="athlete" class="form-control" value="<?= $athlete ?>" id="athlete" required>-->
                    <!--    <span class="error" style="color:red;" id="athlete_error"></span>-->
                    <!--</div>-->
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="text" name="year" class="form-control" value="<?= $year ?>" id="year">
                        <span class="error" style="color:red;" id="year_error"></span>
                    </div>
                    
                     <div>
    <select name="school_id" class="form-control" id="school_id">
        <option>Select School</option>
        <?php
        $result = mysqli_query($con, "SELECT * FROM school_list");
        while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row['school_id'] . "'>" . $row['school_name'] . "</option>";
        }
        ?>
    </select>
    <span class="error" style="color:red;" id="school_error"></span>
</div>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div><br>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function validateForm() {
        var isValid = true;
        var game = $.trim($("#game").val());
        var name = $.trim($("#name").val());
        var age = $.trim($("#age").val());
        var gender = $.trim($("#gender").val());
        var time = $.trim($("#time").val());
        var school_id = $.trim($("#school_id").val());
        var year = $.trim($("#year").val());

        $(".error").text("");
        if (name === "") {
            isValid = false;
            $("#game_error").text("Please enter a name.");
        }
        if (name === "") {
            isValid = false;
            $("#name_error").text("Please enter a name.");
        }

        if (age === "") {
            isValid = false;
            $("#age_error").text("Please enter age.");
        }

        if (gender === "") {
            isValid = false;
            $("#gender_error").text("Please enter gender.");
        }

        if (time === "") {
            isValid = false;
            $("#time_error").text("Please enter time.");
        }

         if (school_id === "") {
            isValid = false;
            $("#school_error").text("Please enter school.");
        }

        if (year === "") {
            isValid = false;
            $("#year_error").text("Please enter year.");
        }

        return isValid;
    }

    $(document).ready(function () {
        $("#game").on("keyup", validateForm);
        $("#name").on("keyup", validateForm);
        $("#age").on("keyup", validateForm);
        $("#gender").on("keyup", validateForm);
        $("#time").on("keyup", validateForm);
       $("#school_id").on("keyup", validateForm);
        $("#year").on("keyup", validateForm);

        $("#productForm").submit(function (e) {
            if (!validateForm()) {
                e.preventDefault();
            }
        });
    });
</script>

<?php include('include/footer.php'); ?>
