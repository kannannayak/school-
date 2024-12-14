<?php
include('include/header.php');
include('include/config.php');


$name="";
$age="";
$tourn_date="";
$location = "";
$game="";
$timing = "";
$image = "";



?>
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded mx-0">
        <div class="col-md-12 ">
            <div class="row my-2">
                <div class="col-md-10">
                <h2>Add Achiever </h2>
                </div>
                <div class="col-md-2">
                    <a href="achievers" class="btn btn-primary">Back</a>
                </div>
                <form action="actions/post_achiever" method="post" enctype="multipart/form-data" id="productForm">
               

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" required class="form-control"  id="name">
                     
                    </div>
                    
                    <div class="form-group">
                        <label for="">Age</label>
                        <input type="text" required name="age" class="form-control" value="<?= htmlspecialchars($age) ?>" id="age" required>
                        
                    </div>

                    <div class="form-group">
                        <label for="">Location </label>
                        <input type="text" name="location" required class="form-control" value="<?= htmlspecialchars($location) ?>" id="location" required>
                        
                    </div>
                     <div class="form-group">
                        <label for="">Game</label>
                        <input type="text" name="game" required class="form-control" value="<?= htmlspecialchars($game) ?>" id="game" required>
                        
                    </div> 
                    
                    <div class="form-group">
                        <label for="">Timing</label>
                        <input type="text" name="timing" required class="form-control" value="<?= htmlspecialchars($timing) ?>" id="timing" required>
                       
                    </div>
                    
                    <div class="form-group">
                        <label for="">Image </label>
                        <input type="file" name="image" required class="form-control" value="<?= htmlspecialchars($image) ?>" id="image">
                    </div>
                     
                     
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
        var name = $.trim($("#name").val());
        var age = $.trim($("#age").val());
        var location = $.trim($("#location").val());
        var game = $.trim($("#game").val());
        var timing = $.trim($("#timing").val());

       
        $(".error").text("");

        if (name === "") {
            isValid = false;
            $("#type_error").text("Please enter a name");
        }
        if (age === "") {
            isValid = false;
            $("#game_error").text("Please enter a age");
        }

        if (location === "") {
            isValid = false;
            $("#name_error").text("Please enter a  location ");
        }

        if (game === "") {
            isValid = false;
            $("#date_error").text("Please enter game");
        }

         if (timing === "") {
            isValid = false;
            $("#timing").text("Please enter a  timing ");
        }

        
        return isValid;
    }

    $(document).ready(function () {
        $("#name").on("change", validateForm);
        $("#age").on("change", validateForm);
        $("#location").on("keyup", validateForm);
        $("#game").on("keyup", validateForm);
         $("#timing").on("keyup", validateForm);
       

        $("#productForm").submit(function (e) {
            if (!validateForm()) {
                e.preventDefault();
            }
        });
    });
</script>
<script>
const textarea = document.getElementById('textareaMax');
const charCountSpan = document.getElementById('char-count');

textarea.addEventListener('input', () => {
  const maxLength = 600;
  const currentLength = textarea.value.length;
  const charCount = maxLength - currentLength;

  charCountSpan.textContent = `Characters left: ${charCount}`;

  if (currentLength > maxLength) {
    textarea.value = textarea.value.substring(0, maxLength);
  }
});
</script>
<script>
  CKEDITOR.replace('textareaMax');
  var editor = CKEDITOR.instances.textareaMax;
  editor.setData('<p>Enter your Description (600 characters only...)</p>');
</script>
<script>
    CKEDITOR.replace('tourn_desc');
</script>
<?php include('include/footer.php'); ?> 
