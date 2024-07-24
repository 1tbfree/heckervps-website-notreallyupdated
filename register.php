<?php
session_start();
require_once 'db_init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $verification_code = bin2hex(random_bytes(16)); // Generate a random verification code

    $stmt = $db->prepare("INSERT INTO users (username, password, email, verification_code) VALUES (:username, :password, :email, :verification_code)");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':verification_code', $verification_code, SQLITE3_TEXT);
    
    if ($stmt->execute()) {
        $_SESSION['pending_verification'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['verification_code'] = $verification_code;
        header("Location: verification_instructions.php");
        exit();
    } else {
        $error = "Registration failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - HeckerVPS</title>
</head>
<body>
    <h2>Create Account</h2>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" required placeholder="Username">
        <input type="password" name="password" required placeholder="Password">
        <input type="email" name="email" required placeholder="Email">
        <input type="submit" value="Register">
    </form>
</body>
</html>
