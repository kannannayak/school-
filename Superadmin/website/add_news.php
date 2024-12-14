<?php include('include/header.php');
include('include/config.php');
?>

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row  bg-light rounded mx-0">
        <div class="col-md-12 ">
            <div class="row my-2">
                <div class="col-md-10">
                    <h3>Add News</h3>
                </div>
                <div class="col-md-2">
                <a href="table_news.php" class="btn btn-primary">Back</a>
                </div>
                <form action="actions/news_post" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">News Name</label>
                        <input type="text" name="news_name" class="form-control" value="">
                    </div>
                    <!-- <div class="form-group">
                        <label for="">Subcategory Description</label>
                        <input type="text" name="sub_cat_desc" class="form-control" value="">
                    </div> -->
                    <!--<div class="form-group">-->
                    <!--    <label for="">News Image</label>-->
                    <!--    <input type="file" name="news_image" class="form-control" value="">-->
                    <!--</div>-->
                    
                    <div class="form-group">
                        <label for="">News URL</label>
                        <input type="text" name="news_url" class="form-control" value="">
                    </div>


                    <div class="form-group">
                        <label for="">News Details</label>
                        <input type="text" name="news_details" class="form-control" value="">
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