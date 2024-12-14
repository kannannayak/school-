<?php
// Include necessary PHP files
include("include/header.php");
include("include/conn.php");
?>
<!-- CSS styles -->
<style>
     .trainee {
        color: #102B6E !important;
        margin-top: 30px;
        margin-left: 15px;
    }
   .card {
        background: #C7E2EF;
        padding: 5px;
        cursor: pointer; 
        margin-top:10px;
     
    }
    .profile-image {
        border-radius: 100px; /* This will make the image round */
        overflow: hidden; /* This ensures the image stays within the rounded border */
        max-width: 200px; /* Make sure images are responsive */
        height: 120px;
        margin-left:30px;
    }
   .modal-content{
    background:#E5F7FF;
    width:1024px;
   } 
  .card1{
       height:300px;
       width:300px;
       
  }
  .card2{
       height:300px;
       width:300px;
  }
</style>
<!-- Title -->
<h4 class="trainee">Student</h4>
<!-- Container for student cards -->
<div class="container">
    <?php
    // Query to fetch student data
    $sql = "SELECT *
    FROM users
    LEFT JOIN trainer ON users.trainer_id = trainer.trainer_id";
    // Execute the query
    $res = mysqli_query($conn, $sql);
    // Check if query was successful and if there are rows returned
    if ($res && mysqli_num_rows($res) > 0) {
        // Loop through each row in the result set
        while ($row = mysqli_fetch_assoc($res)) {
            // Retrieve student data from the current row
            $user_name = $row['user_name'];
            $user_uniq_id = $row['user_uniq_id'];
            $user_age = $row['user_age'];
            $gender = $row['gender'];
            $user_grade = $row['user_grade'];
            $user_school = $row['user_school'];
            $trainer_name = $row['trainer_name'];
    ?>
            <!-- Student card -->
            <div class="card traineeCard" data-name="<?= $user_name ?>" data-id="<?= $user_uniq_id ?>" data-grade="<?= $user_grade ?>" data-age="<?= $user_age ?>" data-school="<?= $user_school ?>" data-trainer="<?= $trainer_name ?>">
                <!-- Card content goes here -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <p><b>Name</b></p>
                        <p><?= $user_name ?></p>
                    </div>
                    <div class="col-md-4">
                        <p><b>ID</b></p>
                        <p><?= $user_uniq_id ?></p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Best Record</b></p>
                        <!-- Add content for best record if needed -->
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>
</div>

<!-- Modal -->
<div class="modal" tabindex="-1" id="traineeModal">
    <!-- Modal content goes here -->
</div>

<?php
// Include footer PHP file
include("include/footer.php");
?>

<!-- JavaScript -->
<script>
    // Event listener for student card click
    document.querySelectorAll('.traineeCard').forEach(card => {
        card.addEventListener('click', function() {
            // Get modal element
            const modal = document.getElementById('traineeModal');
            // Extract data from card attributes
            const { name, id, grade, age, school, trainer } = this.dataset;
            // Populate modal content with student data
            modal.innerHTML = `
                <div class="modal-dialog" style="max-width: 700px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Trainee Details</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="images/user.png" class="profile-image" alt="Profile Image">
                                    <br><br>
                                    <p style="margin-left:30px"><b>Student Name : </b>${name}</p>
                                    <p style="margin-left:30px">Student ID: ${id}</p>
                                </div>
                                <div class="col-md-8">
                                    <p>Student Grade: ${grade}</p>
                                    <p>Student Age: ${age}</p>
                                    <p>Student School : ${school}</p>
                                    <p>Trainer Name : ${trainer}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            // Show the modal
            $('#traineeModal').modal('show');
        });
    });
</script>
