<?php
$title = 'Profile - Online Shop';
include 'header.php';
include 'db.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch current user data
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Handle profile update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username='$username', email='$email', password='$password' WHERE id=$user_id";
    } else {
        $sql = "UPDATE users SET username='$username', email='$email' WHERE id=$user_id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully!";
        $_SESSION['username'] = $username; // Update session username
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://classless.de/classless-tiny.css">
    <link rel="stylesheet" href="bg.css">
</head>
<body>


<h1>Edit Profile</h1>
<form method="POST" action="profile.php">
    <input type="text" name="username" placeholder="Username" value="<?= $user['username'] ?>" required>
    <input type="email" name="email" placeholder="Email" value="<?= $user['email'] ?>" required>
    <input type="password" name="password" placeholder="New Password (optional)">
    <button type="submit">Update Profile</button>
</form>

<?php include 'footer.php'; ?>



</body>
</html>