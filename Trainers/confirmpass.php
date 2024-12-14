<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirm password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .card {
            max-width: 1300px;
            margin: 50px auto;
            background-color:#E6F4FB ;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);

        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
        }
        .btn{
            background: linear-gradient( to bottom, #102B6E, #0191D6);
            color:#fff;
        }
       .login {
             /* background: linear-gradient(to bottom, #102B6E, #0191D6);
            -webkit-background-clip: text; 
            background-clip: text;
            color: transparent;
            font-weight:bold;  */
            color:#102B6E;
}


        @media (min-width: 768px) {
            .col-md-4 {
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }
        }
        .center-image {
  display: block; /* Ensure the image is treated as a block element */
  margin: 0 auto; /* Center the image horizontally */
}


    </style>
</head>
<body>
<div class="container mt-5">
  <div class="row justify-content-center">

    <div class="col-md-6">
      <div class="card">

        <div class="card-body">
          <h3 class="card-title login text-center"><b>Confirm Password</b></h3>
          <p class="paragraph text-center">Enter the password to change the Password</p>

          
          <form id="passwordForm" action="action/update_password.php" method="post">
            <div class="mb-3">
              <label for="newPassword" class="form-label">New Password</label>
              <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="New Password">
            </div>
            <div class="mb-3">
              <label for="confirmPassword" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
            </div>
            <div class="text-center">
              <button type="submit"  name="submit" class="btn btn-primary">Submit</button>
            </div>
            <br>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS (Optional, only if you need JS functionalities) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById("passwordForm").addEventListener("submit", function(event) {
        var newPassword = document.getElementById("newPassword").value;
        var confirmPassword = document.getElementById("confirmPassword").value;

        if (newPassword !== confirmPassword) {
            alert("Passwords do not match!");
            event.preventDefault(); // Prevent form submission
        }
    });
</script>
</body>
</html>