<?php include('include/header.php');
include('include/config.php');

if(isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $image_id = $_GET['edit'];
    $stmt = $con->prepare("SELECT * FROM `images` WHERE image_id=?");
    $stmt->bind_param("i", $image_id);
    $stmt->execute();
    $res = $stmt->get_result();
    
    // Check if any row is returned
    if($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        // $game_type_name= htmlspecialchars($row['game_type_name']);
        $images_name= htmlspecialchars($row['images_name']);
        
    } else {
        echo "No record found.";
        exit; // Stop execution if no record found
    }
} else {
    echo "Invalid request.";
    exit; // Stop execution if edit parameter is missing or invalid
}
?>

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row  bg-light rounded mx-0">
        <div class="col-md-12 ">
            <div class="row my-2">
                <div class="col-md-10">
                    <h3>Edit image</h3>
                </div>
                <div class="col-md-2">
                <a href="table_img" class="btn btn-primary">Back</a>
                </div>
                <form action="actions/post_edit_img" method="post" enctype="multipart/form-data">
                <input type="hidden" name="edit" value="<?php echo $image_id; ?>">

                   
                    <!-- <div class="form-group">
                        <label for="">Subcategory Description</label>
                        <input type="text" name="sub_cat_desc" class="form-control" value="">
                    </div> -->
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="images_name" class="form-control" value="<?= $images_name?>">
                    </div>
                    
                
                    <br>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button>
                    </div>
                </form>
            </div>

        </div>
<!-- Blank End -->


<?php include('include/footer.php'); ?>