<?php
session_start(); 

if (isset($_POST['submit'])) {
    include('../database/dbConfig.php');
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM investors WHERE email_id= '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['email'] = $email; 
        $_SESSION['message'] = "Login successful";
        $_SESSION['message_type'] = "success";
        header("Location: ../investor/dashboard.php");
        exit();
    } else {
        echo "Wrong email or password"; 
        $_SESSION['message'] = "Wrong email or password";
        $_SESSION['message_type'] = "danger";
    }
    $conn->close();
}
?>
