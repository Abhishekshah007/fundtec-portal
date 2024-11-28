<?php
session_start(); 
if (!isset($_SESSION['email'])) {
    header("Location: ../authentication/login-investor.php");
    exit();
}
$email = $_SESSION['email'];
if(isset($_POST['submit'])){

    include('../database/dbConfig.php');
    $amount = $_POST['investmentAmount'];
    $date = $_POST['investmentDate'];
    if (empty($amount) || empty($date)) {
        echo "Amount and Date are required.";

        exit();
    }

    $sql = "INSERT INTO transactions (email_id, amount, transaction_type,date) VALUES ('$email', '$amount', 'Investment', '$date')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
       
        header("Location: dashboard.php");
        $_SESSION['message'] = "$amount added successfully";
        $_SESSION['message_type'] = "success";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();



}
?>