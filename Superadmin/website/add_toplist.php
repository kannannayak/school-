<?php
include('include/header.php');
include('include/config.php');

// Initialize $name variable to an empty string\
$toper_id="";
$game="";
$name = "";
$age="";
$gender="";
$school_id="";
$time="";
// $athlete="";
$year="";

?>
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded mx-0">
        <div class="col-md-12 ">
            <div class="row my-2">
                <div class="col-md-10">
                    <h3>Add  Details</h3>
                </div>
                <div class="col-md-2">
                    <a href="toplist" class="btn btn-primary">Back</a>
                </div>
                <form action="actions/post_toplist" method="post" enctype="multipart/form-data" id="productForm">
                <div>
                    <label>Game Type</label>
    <select name="game" class="form-control" id="game">
        <option>Select Game Type</option>
        <?php
        $result = mysqli_query($con, "SELECT * FROM game_type_web");
        while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row['game_type_id'] . "'>" . $row['game_type_name'] . "</option>";
        }
        ?>
    </select>
    <span class="error" style="color:red;" id="game_error"></span>
</div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>" id="name">
                        <span class="error" style="color:red;" id="name_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="text" name="age" class="form-control" value="<?= htmlspecialchars($age) ?>" id="age" required>
                        <span class="error" style="color:red;" id="age_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <input type="text" name="gender" class="form-control" value="<?= htmlspecialchars($gender) ?>" id="gender" required>
                        <span class="error" style="color:red;" id="gender_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="time">Time</label>
                        <input type="text" name="time" class="form-control" value="<?= htmlspecialchars($time) ?>" id="time" required>
                        <span class="error" style="color:red;" id="time_error"></span>
                    </div>
                    <!--<div class="form-group">-->
                    <!--    <label for="athlete">Athlete</label>-->
                    <!--    <input type="text" name="athlete" class="form-control" value="<?= htmlspecialchars($athlete) ?>" id="athlete" required>-->
                    <!--    <span class="error" style="color:red;" id="athlete_error"></span>-->
                    <!--</div>-->
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="text" name="year" class="form-control" value="<?= htmlspecialchars($year) ?>" id="year">
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

                    <br>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="update_profile" value="submit">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div><br>
</div>

<!-- Blank End -->

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

        if (game === "") {
            isValid = false;
            $("#game_error").text("Please select a game.");
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
        $("#game").on("change", validateForm);
        $("#name").on("keyup", validateForm);
        $("#age").on("keyup", validateForm);
        $("#gender").on("keyup", validateForm);
        $("#time").on("keyup", validateForm);
        // $("#athlete").on("keyup", validateForm);
        $("#year").on("keyup", validateForm);

        $("#productForm").submit(function (e) {
            if (!validateForm()) {
                e.preventDefault();
            }
        });
    });
</script>
<script>
    CKEDITOR.replace('pro_desc');
</script>
<?php include('include/footer.php'); ?> 
