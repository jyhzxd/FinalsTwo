<?php
include 'header.php';
include 'db.php';

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
        $username = $_POST ["username"];
        $password = $_POST ["password"];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn -> query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: product.php");
            exit();
        } else {
            echo "<p style='color:red;'>Invalid Credentials</p>";
        }
    } else {
        echo "<p style='color:red;'>User  not found</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://classless.de/classless-tiny.css">
    <link rel="stylesheet" href="bg.css">
    <title>Login</title>
</head>
<body>



<form method="POST" action="">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Submit</button>
</form>



</body>
</html>