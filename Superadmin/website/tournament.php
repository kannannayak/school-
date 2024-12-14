<?php
include('include/header.php');
include('include/config.php');


$tourn_type="";
$game_type="";
$tourn_date="";
$tourn_name = "";



?>
<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded mx-0">
        <div class="col-md-12 ">
            <div class="row my-2">
                <div class="col-md-10">
                <h2>Add Tournament </h2>
                </div>
                <div class="col-md-2">
                    <a href="table_tournament" class="btn btn-primary">Back</a>
                </div>
                <form action="actions/post_tour" method="post" enctype="multipart/form-data" id="productForm">
               

                    <div class="form-group">
                        <label for="">Tournamnet Type</label>
                        <input type="text" name="tourn_type" class="form-control" value="<?= htmlspecialchars($tourn_type) ?>" id="tourn_type">
                        <span class="error" style="color:red;" id="type_error"></span>
                    </div>
                    
                    
                    <!--<div class="form-group">-->
                    <!--    <label for="">Game Type</label>-->
                    <!--    <input type="text" name="game_type" class="form-control" value="<?= htmlspecialchars($game_type) ?>" id="game_type">-->
                    <!--    <span class="error" style="color:red;" id="game_error"></span>-->
                    <!--</div>-->
                    <label>Game type</label>
                     <div>
    <select name="game_type" class="form-control" id="game_type">
        <option>Select Game Type</option>
        <?php
        $result = mysqli_query($con, "SELECT * FROM game_type_web");
        while ($row = mysqli_fetch_array($result)) {
            echo "<option value='" . $row['game_type_id'] . "'>" . $row['game_type_name'] . "</option>";
        }
        ?>
    </select>
    <span class="error" style="color:red;" id="game_error"></span>
</div>

                    <div class="form-group">
                        <label for="">Tournamnet Name</label>
                        <input type="text" name="tourn_name" class="form-control" value="<?= htmlspecialchars($tourn_name) ?>" id="tourn_name" required>
                        <span class="error" style="color:red;" id="name_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="">Tournament Date</label>
                        <input type="date" name="tourn_date" class="form-control" value="<?= htmlspecialchars($tourn_date) ?>" id="tourn_date" required>
                        <span class="error" style="color:red;" id="date_error"></span>
                    </div>
                    <!--  <div class="form-group">-->
                    <!--    <label for="">Image</label>-->
                    <!--    <input type="file" name="tourn_image" class="form-control" value="<?= htmlspecialchars($tourn_image) ?>" id="tourn_image">-->
                    <!--</div>-->
                    
                    <!--<div class="form-group">-->
                    <!--    <label for="">Tournament URL</label>-->
                    <!--    <input type="text" name="tourn_url" class="form-control" value="<?= htmlspecialchars($tourn_url) ?>" id="tourn_url" required>-->
                    <!--    <span class="error" style="color:red;" id="date_error"></span>-->
                    <!--</div>-->
                     <div class="form-group">
                        <label for="">Tournament Venue</label>
                        <input type="text" name="tourn_details" class="form-control" value="<?= htmlspecialchars($tourn_details) ?>" id="tourn_details" required>
                        <span class="error" style="color:red;" id="date_error"></span>
                    </div>
                     <h4 class="text-center">Tournamnet Description</h4>
     
                    <!--<textarea id="textareaMax" class="form-control" placeholder="Enter your Description 625 characters only..." maxlength="1000" name="tourn_desc"><?= htmlspecialchars($tourn_desc)?></textarea>-->
<textarea id="textareaMax" class="form-control" placeholder="Enter your Description (600 characters only)" maxlength="600" name="tourn_desc"><?= htmlspecialchars($tourn_desc)?></textarea>
<span id="char-count" style="font-size: 12px; color: #666;"></span>
                    <br>
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
        var tourn_type = $.trim($("#tourn_type").val());
        var game_type = $.trim($("#game_type").val());
        var tourn_name = $.trim($("#tourn_name").val());
        var tourn_date = $.trim($("#tourn_date").val());
       
        $(".error").text("");

        if (tourn_type === "") {
            isValid = false;
            $("#type_error").text("Please enter a type");
        }
        if (game_type === "") {
            isValid = false;
            $("#game_error").text("Please enter a type");
        }

        if (tourn_name === "") {
            isValid = false;
            $("#name_error").text("Please enter a  tournament name");
        }

        if (tourn_date === "") {
            isValid = false;
            $("#date_error").text("Please enter date");
        }

         if (tourn_url === "") {
            isValid = false;
            $("#tourn_url").text("Please enter a  tournament URL");
        }

        if (tourn_details === "") {
            isValid = false;
            $("#tourn_details").text("Please enter date");
        }
        return isValid;
    }

    $(document).ready(function () {
        $("#tourn_type").on("change", validateForm);
        $("#game_type").on("change", validateForm);
        $("#tourn_name").on("keyup", validateForm);
        $("#tourn_date").on("keyup", validateForm);
         $("#tourn_url").on("keyup", validateForm);
        $("#tourn_details").on("keyup", validateForm);

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
