<?php include('include/header.php');
include('include/config.php');
?>

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row  bg-light rounded mx-0">
        <div class="col-md-12 ">
            <div class="row my-2">
                <div class="col-md-12">
                    <h3>Add Category</h3>
                </div>
                <form action="actions/category.php" method="post" enctype="multipart/form-data" id="addCategoryForm">
                    <div class="form-group">
                        <label for="cat_name">Category Name</label>
                        <input type="text" name="cat_name" class="form-control" id="cat_name" value="">
                    </div>
                    <div class="form-group">
                        <label for="cat_desc">Category Description</label>
                        <input type="text" name="cat_desc" class="form-control" id="cat_desc" value="">
                    </div>

                    <div class="form-group">
                        <label for="image1">Category Image1</label>
                        <input type="file" name="image1" class="form-control" id="image1" value="">
                    </div>
                    <br>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div><br>
    <a href="products" class="btn btn-primary">Back To Products</a>
</div>
<!-- Blank End -->

<?php include('include/footer.php'); ?>

<!-- Add the SweetAlert2 library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {
    $('#addCategoryForm').submit(function () {

        // Get the values of the Category Name and Category Description input fields
        var categoryName = $('#cat_name').val().trim();
        var categoryDesc = $('#cat_desc').val().trim();
        var image1 = $('#image1').val();

        // Check if Category Name is empty
        if (categoryName === '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Category Name cannot be empty.'
            });
            return false; // Prevent form submission
        }

        // Check if Category Description is empty
        if (categoryDesc === '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Category Description cannot be empty.'
            });
            return false; // Prevent form submission
        }

        // Check if an image file is selected
        if (image1 === '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select an image file.'
            });
            return false; // Prevent form submission
        }

        // Check if the selected file has a valid extension (e.g., jpg, jpeg, png, gif)
        var validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        var fileExtension = image1.split('.').pop().toLowerCase();
        if ($.inArray(fileExtension, validExtensions) === -1) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Invalid file extension. Only jpg, jpeg, png, and gif files are allowed.'
            });
            return false; // Prevent form submission
        }

        // If all validations pass, allow the form to be submitted
        return true;
    });
});
</script>
