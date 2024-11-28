<?php
include 'header.php';
include 'db.php';

    if ($_SERVER ["REQUEST_METHOD"] == "POST") {
        $username = $_POST ["username"];
        $email = $_POST ["email"];
        $password = password_hash($_POST ['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) 
        VALUES ('$username', '$email' , '$password')";

        if ($conn -> query($sql) === TRUE){
            echo "Registration Successful!";
            header("Location: login.php");
            exit();
        }else{
            echo "Error!!!" .$conn ->  error;
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
    <title>Registration</title>
</head>
<body>

<form method="POST" action="register.php">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>


</form>
</body>
</html>