<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../authentication/login-investor.php");
    exit();
}

$email = $_SESSION['email'];

if (isset($_POST['submit'])) {
    include('../database/dbConfig.php');

    $amount = $_POST['investmentAmount'];
    $date = $_POST['investmentDate'];
    if (empty($amount) || empty($date)) {
        echo "Amount and Date are required.";
        exit();
    }

    $getSql = "SELECT SUM(amount) AS totalInvestment FROM transactions WHERE email_id = '$email' AND transaction_type = 'Investment'";
    $result = $conn->query($getSql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalInvestment = $row['totalInvestment'] ?? 0;

        if ($amount > $totalInvestment) {
            echo "Withdrawal amount cannot be greater than the total investment amount.";
            $_SESSION['message'] = "Withdrawal amount cannot be greater than the total investment amount.";
            $_SESSION['message_type'] = "error";
            exit();
        }
    } else {
        echo "No investments found for this user.";
        $_SESSION['message'] = "No investments found for this user.";
        $_SESSION['message_type'] = "error";
        exit();
    }

    $sql = "INSERT INTO transactions (email_id, amount, transaction_type, date) VALUES ('$email', '$amount', 'Withdrawal', '$date')";
    if ($conn->query($sql) === TRUE) {
        echo "New withdrawal record created successfully.";
        header("Location: dashboard.php");
        $_SESSION['message'] = "$amount withdrawn successfully.";
        $_SESSION['message_type'] = "success";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
