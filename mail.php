<?php
session_start();
include("db.php");

// For real emails, configure PHPMailer here
// For now, we just simulate

if (isset($_POST['register'])) {
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password);

    if ($stmt->execute()) {
        $_SESSION['flash'] = "Account created! Welcome email sent to $email";
        header("Location: login.php");
    } else {
        $_SESSION['error'] = "Error: email might already exist.";
        header("Location: index.php");
    }
}
