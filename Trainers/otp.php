<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.card{
    max-width: 1300px;
    margin: 50px auto;
    margin-top:150px;
    background-color:#E6F4FB ;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.form-label {
    font-weight: bold;
}

.form-group {
            margin-bottom: 20px;
        }


.btn{
    background: linear-gradient(to bottom, #102B6E, #0191D6);
    color:#fff;
}


@media (min-width: 768px) {
    .col-md-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
}
.otp{
    color:#102B6E;
             /* background: linear-gradient(to bottom, #102B6E, #0191D6);
            -webkit-background-clip: text; 
            background-clip: text;
            color: transparent;
            font-weight:bold;  */
}



input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0; /* Optional: Remove the margin */}

</style>
<body>

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
            <h3 class="text-center  otp"><b>Enter the OTP </b></h3>

                <p class="paragraph text-center">We've send then code to your phone</p>
                   
                    <form action="#" method="POST">
                        <div class="form-group ">
                            <label for="otp">Enter OTP</label>
                            <input type="number" class="form-control" id="otp" name="get_otp" placeholder="Enter the otp" required>
                        </div>
                        <!-- <div class="text-center">
                            <button type="submit" class="btn btn-primary">Get OTP</button>
                        </div> -->
                        <div class="text-center">
                        
                        <input value="verify" name="verify" type="submit" class="btn btn-primary"></input>

                        </div>
                    </form>
                
            </div>
        </div>

    </div>



<!-- Bootstrap JS (Optional, only if you need JS functionalities) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php 
    include("include/conn.php");
    if(isset($_POST["verify"])){
        $otp = $_SESSION['otp'];
        $email = $_SESSION['mail'];
        $get_otp = $_POST['get_otp'];

        if($otp != $get_otp){
            ?>
           <script>
               alert("Invalid OTP code");
           </script>
           <?php
        }else{
            
            ?>
             <script>
                 alert("Verfiy account done, you may sign in now");
                   window.location.replace("confirmpass.php");
             </script>
             <?php
        }

    }

?>