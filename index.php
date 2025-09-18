<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - Task List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Create Account</h2>
<form method="POST" action="mail.php">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="register">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
