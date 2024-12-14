<?php
include("include/header.php");
include("include/conn.php");
?>

<style>
/* Add your custom styles here */
</style>

<html lang="en">
<head>
    <title>Notification</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</head>
<body>

<div id="page-wrapper" style="min-height:142vh;">
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>Notification</h1>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <form action="action/post_notify.php" method="POST">
                            <h1>Student Notification</h1>
                            <div class="form-group">
                                <select id="student-select" class="student form-control select" name="user[]" multiple="multiple">
                                    <option value="all">Select ALL</option>
                                    <?php
                                     $school_id = $_SESSION['school_id'];
                                    $result = mysqli_query($conn, "SELECT us.* 
                                    FROM users AS us 
                                    JOIN school_list AS sch ON us.school_id = sch.school_id
                                    WHERE sch.school_id = $school_id");
                                    while ($user_row = mysqli_fetch_array($result)) {
                                        echo "<option value='" . $user_row['user_id'] . "'>" . $user_row['user_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message">Message box</label>
                                <textarea class="form-control" id="message" name="message" rows="5" style="resize: none;"></textarea>
                            </div>
                            <button type="submit" name="submit" class="send btn btn-success">Send</button>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <form action="action/post_notify.php" method="POST">
                            <h1>Trainer Notification</h1>
                            <div class="form-group">
                                <select id="trainer-select" class="trainers form-control select" name="trainer[]" multiple="multiple">
                                    <option value="all">Select ALL</option>
                                    <?php
                                      $school_id = $_SESSION['school_id'];
                                    $result = mysqli_query($conn, "SELECT tri.* 
                                    FROM trainer AS tri
                                     JOIN school_list AS sch ON tri.school_id = sch.school_id
                                    WHERE sch.school_id = $school_id");
                                    while ($user_row = mysqli_fetch_array($result)) {
                                        echo "<option value='" . $user_row['trainer_id'] . "'>" . $user_row['trainer_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tri_message">Message box</label>
                                <textarea class="form-control" id="tri_message" name="tri_message" rows="5" style="resize: none;"></textarea>
                            </div>
                            <button type="submit" name="tri_submit" class="send btn btn-success">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.student').select2();
        $('.trainers').select2();

        $('#student-select').on('change', function() {
            if ($(this).val().includes('all')) {
                let allSelected = $('#student-select > option').map(function() {
                    return $(this).val();
                }).get();
                $('#student-select').val(allSelected).trigger('change');
            }
        });

        $('#trainer-select').on('change', function() {
            if ($(this).val().includes('all')) {
                let allSelected = $('#trainer-select > option').map(function() {
                    return $(this).val();
                }).get();
                $('#trainer-select').val(allSelected).trigger('change');
            }
        });
    });
</script>

<script>
    <?php
    if (isset($_GET['msg']) && !empty($_GET['msg'])) {
        $msg = $_GET['msg'];
    ?>
        swal("", "<?php echo $msg; ?>", "success");
        if (window.history.replaceState) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    <?php
    }
    ?>
</script>

</body>
</html>

<?php
include("include/footer.php");
?>
