<?php
include 'conn.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $_SESSION['email'] = $email;

    $sql = "SELECT * FROM users WHERE email='$email'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($query);

    if ($data && password_verify($password, $data['password'])) {
        $otp = rand(100000, 999999);
        $otp_expiry = date("Y-m-d H:i:s", strtotime("+3 minute"));
        $subject = "Your OTP for Login";
        $message = "Your OTP is: $otp";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.titan.email';
        $mail->SMTPAuth = true;
        $mail->Username = 'security@chayilrealtors.online'; //host email 
        $mail->Password = 'MydogRoxy1@'; // app password of your host email
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->isHTML(true);
        $mail->setFrom('security@chayilrealtors.online', 'Online Examination System');//Sender's Email & Name
        $mail->addAddress($email); //Receiver's Email and Name
        $mail->Subject = ("$subject");
        $mail->Body = $message;
        $mail->send();

        $sql1 = "UPDATE users SET otp='$otp', otp_expiry='$otp_expiry' WHERE id=" . $data['id'];
        $query1 = mysqli_query($conn, $sql1);

        $_SESSION['temp_user'] = ['id' => $data['id'], 'otp' => $otp];
        header("Location: otp_verification.php");
        exit();
    } else {
        ?>
        <script>
            alert("Invalid Email or Password. Please try again.");
            function navigateToPage() {
                window.location.href = 'login.php';
            }
            window.onload = function () {
                navigateToPage();
            }
        </script>
        <?php

    }
}
?>




