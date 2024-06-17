<?php
require_once 'classes/User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($user->login($username, $password)) {
        header('Location: events.php');
    } else {
        echo 'Login failed';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">

    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <input type="submit" value="Login">
    </form>
    <a href="index.php">Back to Home</a>
</body>
</html>
