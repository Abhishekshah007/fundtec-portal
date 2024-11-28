<?php
session_start();

if(isset($_POST['submit'])){
    include('../database/dbConfig.php');
    $email =$_POST['email'];
    $password =$_POST['password'];

    $sql = "SELECT * FROM broker WHERE email_id = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['adminEmail'] = $email;
        $_SESSION['message'] = "Login successful as Broker";
        $_SESSION['message_type'] = "success";
        header("Location: ../broker/dashboard.php");
        exit();
    } else {
        echo "Wrong email or password";
        $_SESSION['message'] = "Wrong email or password";
        $_SESSION['message_type'] = "danger";
        
    }
    $conn->close();


}

?>