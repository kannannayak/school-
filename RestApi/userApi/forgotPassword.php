<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/database.php';
require 'PHPMailer/PHPMailerAutoload.php'; // Ensure this path is correct

// Check if the email is posted in the form data
if (!isset($_POST['email'])) {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Email is required']);
    exit;
}

$email = $_POST['email'];

// Verify the email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Invalid email format']);
    exit;
}

// Check if the email exists in the database
$database = new Database();
$db = $database->getConnection();

$check_query = $db->prepare("SELECT user_id FROM `users` WHERE user_email = :email");
$check_query->bindParam(':email', $email);
$check_query->execute();
$row = $check_query->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $user_id = $row['user_id'];
    $_SESSION['user_id'] = $user_id;

    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['mail'] = $email;

    // Update the OTP in the users table
    $update_query = $db->prepare("UPDATE `users` SET forgot_otp = :otp WHERE user_id = :user_id");
    $update_query->bindParam(':otp', $otp);
    $update_query->bindParam(':user_id', $user_id);
    $update_query->execute();

    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    $mail->Username = 'dhandapanisekar14@gmail.com'; // Update with your email
    $mail->Password = 'vifukxoaybvnamza'; // Update with your email password

    $mail->setFrom('dhandapanisekar14@gmail.com', 'OTP Verification'); // Update with your email
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = "Your verify code";
    $mail->Body = "<p>Dear user,</p><h3>Your verify OTP code is $otp</h3><br><br><p>With regards,</p><b>The Mithraa</b>";

    if (!$mail->send()) {
        http_response_code(500);
        echo json_encode(['status' => false, 'message' => 'OTP send failed, invalid email']);
    } else {
        http_response_code(200);
        echo json_encode(['status' => true, 'message' => 'OTP sent to ' . $email]);
    }
} else {
    http_response_code(404);
    echo json_encode(['status' => false, 'message' => 'This email is not registered']);
}
?>

