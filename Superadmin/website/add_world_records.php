<?php
include('include/header.php');
include('include/config.php');

// Initialize variables
$rec_id = "";
$game = "";
$name = "";
$age = "";
$gender = "";
$timing = "";
$country = "";
$year = "";

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded mx-0">
        <div class="col-md-12">
            <div class="row my-2">
                <div class="col-md-10">
                    <h3>Add Details</h3>
                </div>
                <div class="col-md-2">
                    <a href="toplist" class="btn btn-primary">Back</a>
                </div>
                <form action="actions/post_records.php" method="post" enctype="multipart/form-data" id="productForm">

                    <div>
                        <label>Select Age</label>
                        <select name="age_id" class="form-control" id="age_id" required>
                            <option>Select Age</option>
                            <?php
                            $result = mysqli_query($con, "SELECT * FROM website_agelist");
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['age_id'] . "'>" . $row['age_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label>Game Type</label>
                        <select name="game" class="form-control" id="game" required>
                            <option>Select Game Type</option>
                            <?php
                            $result = mysqli_query($con, "SELECT * FROM game_type_web");
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['game_type_id'] . "'>" . $row['game_type_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label>Gender</label>
                        <select name="gender_id" class="form-control" id="gender_id" required>
                            <option>Select Gender</option>
                            <?php
                            $result = mysqli_query($con, "SELECT * FROM gender");
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row['gender_id'] . "'>" . $row['gender_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" required class="form-control" value="<?= htmlspecialchars($name) ?>" id="name">
                    </div>
                    <div class="form-group">
                        <label for="timing">Timing</label>
                        <input type="text" name="timing" class="form-control" value="<?= htmlspecialchars($timing) ?>" id="timing" required>
                    </div>

                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" name="country" class="form-control" value="<?= htmlspecialchars($country) ?>" id="country" required>
                    </div>

                    <div class="form-group">
                        <label for="create_date">Year</label>
                        <input type="date" name="create_date" class="form-control" value="<?= htmlspecialchars($year) ?>" id="create_date">
                    </div>

                    <br>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div><br>
</div>
<!-- Blank End -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php include('include/footer.php'); ?>
