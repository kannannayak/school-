<?php
// Include header
include('include/header.php');

// Include configuration
include('include/config.php');

if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $tut_id = $_GET['edit'];
    
    // Prepare and execute the SQL query using prepared statements
    $stmt = $con->prepare("SELECT * FROM `tutorial` WHERE 	tut_id  = ?");
    $stmt->bind_param("i", $tut_id);
    $stmt->execute();
    $res = $stmt->get_result();
    
    // Check if any row is returned
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $tut_name = htmlspecialchars($row['tut_name']);
        // $tutorial_web_image = htmlspecialchars($row['tutorial_web_image']);
        $tut_url = htmlspecialchars($row['tut_url']);
            $tut_details = htmlspecialchars($row['tut_details']);
        // $tutorial_web_details = htmlspecialchars($row['tutorial_web_details']);
    } else {
        echo "No record found.";
        exit; // Stop execution if no record found
    }
} else {
    echo "Invalid request.";
    exit; // Stop execution if edit parameter is missing or invalid
}
?>

<!-- HTML form for editing tutorials -->
<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded mx-0">
        <div class="col-md-12">
            <div class="row my-2">
                <div class="col-md-10">
                    <h3>Edit Video</h3>
                </div>
                <div class="col-md-2">
                    <a href="video_table" class="btn btn-primary">Back</a>
                </div>
                <form action="actions/edit_post_video.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="tut_name" class="form-control" value="<?= $tut_name ?>">
                    </div>
                  
                    <!--<div class="form-group">-->
                    <!--    <label for="">Tutorial Image</label>-->
                    <!--    <input type="file" name="tutorial_web_image" class="form-control">-->
                    <!--    <input type="hidden" name="tutorial_web_imageold" class="form-control" value="<?= $tutorial_web_image ?>">-->
                    <!--</div>-->
                     
                    <div class="form-group">
                        <label for="">Youtube url</label>
                        <input type="text" name="tut_url" class="form-control" value="<?= $tut_url ?>">
                    </div>
                    
                    <!--<div class="form-group">-->
                    <!--    <label for="">Tutorial URL</label>-->
                    <!--    <input type="file" name="tutorial_source_file" class="form-control" accept=".mp4">-->

                    <!--    <input type="hidden" name="tutorial_source_fileold" class="form-control" value="<?= $tutorial_source_file ?>">-->
                    <!--</div>-->
                         <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" name="tut_details" class="form-control" value="<?= $tut_details ?>">
                    </div>
                    <input type="hidden" name="edit" value="<?= $tut_id ?>">

                    <br>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>
