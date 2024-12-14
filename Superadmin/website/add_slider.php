<?php include('include/header.php');
include('include/config.php');
?>

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row  bg-light rounded mx-0">
        <div class="col-md-12 ">
            <div class="row my-2">
                <div class="col-md-10">
                    <h3>Add image</h3>
                </div>
                <div class="col-md-2">
                <a href="table_img" class="btn btn-primary">Back</a>
                </div>
                <form action="actions/web_img.php" method="post" enctype="multipart/form-data">
                    
                    <!-- <div class="form-group">
                        <label for="">Subcategory Description</label>
                        <input type="text" name="sub_cat_desc" class="form-control" value="">
                    </div> -->
                    <div class="form-group">
                        <label for="">Image</label>
                        <input type="file" name="web_img" class="form-control" value="">
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