<?php include('include/header.php');
include('include/config.php');
?>

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row  bg-light rounded mx-0">
        <div class="col-md-12 ">
            <div class="row my-2">
                <div class="col-md-10">
                    <h3>Add Tutorials</h3>
                </div>
                <div class="col-md-2">
                <a href="table_tutorial" class="btn btn-primary">Back</a>
                </div>
                <form action="actions/tutorials_add.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Tutorial Name</label>
                        <input type="text" name="tutorial_web_name" class="form-control" value="">
                    </div>
                  
                    <!--<div class="form-group">-->
                    <!--    <label for="">Tutorial Image</label>-->
                    <!--    <input type="file" name="tutorial_web_image" class="form-control" value="">-->
                    <!--</div>-->
                     
                    <div class="form-group">
                        <label for="">Tutorial Description</label>
                        <input type="text" name="tutorial_web_details" class="form-control" value="">
                    </div>

                    <div class="form-group">
                        <label for="">Video Url</label>
                        <input type="text" name="tutorial_web_url" class="form-control" value="">
                    </div>
                 <!--<div class="form-group">-->
                 <!--       <label for="">App Url</label>-->
                 <!--       <input type="text" name="video_web" class="form-control" value="">-->
                 <!--   </div>-->
                    <br>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button>
                    </div>
                </form>
            </div>

        </div>
  
  

<!-- Blank End -->


<?php include('include/footer.php'); ?>