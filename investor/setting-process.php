<?php 
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../authentication/login-investor.php");
    exit();
}

include '../database/dbConfig.php'; 

if (isset($_POST['submit'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $email = $_SESSION['email'];

    $sql = "SELECT password FROM investors WHERE email_id = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dbPassword = $row['password'];

        if ($currentPassword !== $dbPassword) {
            $_SESSION['message'] = "Current password is incorrect.";
            $_SESSION['message_type'] = "error";
            header("Location: setting.php");
            exit();
        }

        if ($currentPassword === $newPassword) {
            $_SESSION['message'] = "New password cannot be the same as the current password.";
            $_SESSION['message_type'] = "error";
            header("Location: setting.php");
            exit();
        }

        if ($newPassword !== $confirmPassword) {
            $_SESSION['message'] = "New password and confirm password do not match.";
            $_SESSION['message_type'] = "error";
            header("Location: setting.php");
            exit();
        }


        $updateSql = "UPDATE investors SET password = '$newPassword' WHERE email_id = '$email'";
        if ($conn->query($updateSql) === TRUE) {
            $_SESSION['message'] = "Password updated successfully.";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Error updating password.";
            $_SESSION['message_type'] = "error";
        }
    } else {
        $_SESSION['message'] = "User not found.";
        $_SESSION['message_type'] = "error";
    }

    header("Location: setting.php");
    exit();
}
?>
