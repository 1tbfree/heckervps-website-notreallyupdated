<?php
session_start();
if (!isset($_SESSION['pending_verification'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Instructions - HeckerVPS</title>
</head>
<body>
    <h2>Account Verification Required</h2>
    <p>To complete your registration, please follow these steps:</p>
    <ol>
        <li>Join our Discord server: [Your Discord Server Invite Link]</li>
        <li>Go to the #support channel</li>
        <li>Send a message with your username and this verification code: <strong><?php echo $_SESSION['verification_code']; ?></strong></li>
        <li>Wait for a staff member to verify your account</li>
    </ol>
    <p>Once verified, you will be able to log in to your account.</p>
</body>
</html>
