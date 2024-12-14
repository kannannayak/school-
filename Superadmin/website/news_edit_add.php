<?php 
include('include/header.php');
include('include/config.php');

if(isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $news_id = $_GET['edit'];
    $stmt = $con->prepare("SELECT * FROM `news` WHERE news_id=?");
    $stmt->bind_param("i", $news_id);
    $stmt->execute();
    $res = $stmt->get_result();
    
    // Check if any row is returned
    if($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $news_name= htmlspecialchars($row['news_name']);
        $news_image= htmlspecialchars($row['news_image']);
        $news_url= htmlspecialchars($row['news_url']);
        $news_details= htmlspecialchars($row['news_details']);
       
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
                    <h3>Edit News</h3>
                </div>
                <div class="col-md-2">
                <a href="table_news" class="btn btn-primary">Back</a>
                </div>
                <form action="actions/edit_news.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="edit" value="<?= $news_id ?>">
                    <div class="form-group">
                        <label for="">News Name</label>
                        <input type="text" name="news_name" class="form-control" value="<?= $news_name ?> ">
                    </div>
                  
                    <!--<div class="form-group">-->
                    <!--    <label for="news_image">News Image</label>-->
                    <!--    <input type="file" name="news_image" class="form-control" value="<?= $news_image  ?>">-->
                    <!--</div>-->
                     
                    <div class="form-group">
                        <label for="">News url</label>
                        <input type="text" name="news_url" class="form-control" value="<?= $news_url ?>">
                    </div>
                    
                         
                    <div class="form-group">
                        <label for="">News Description </label>
                        <input type="text" name="news_details" class="form-control" value="<?= $news_details ?>">
                    </div>

                    
                
                    <!-- <input type="hidden" name="news_id" value="<?= $news_id ?>"> -->
                    <br>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Blank End -->

<?php include('include/footer.php'); ?>