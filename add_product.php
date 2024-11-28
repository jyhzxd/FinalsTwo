<?php
$title = 'Add Product - Online Shop';
include 'header.php';
include 'db.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = null;

    // Handle file upload
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";

        // Create the directory if it doesn't exist
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $image = $target_dir . basename($_FILES["image"]["name"]);

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
            $image = $conn->real_escape_string($image);
        } else {
            echo "<p style='color: red;'>File upload failed. Please try again.</p>";
            $image = null;
        }
    }

    // Insert product into the database
    $sql = "INSERT INTO products (name, description, price, quantity, image) 
            VALUES ('$name', '$description', '$price', '$quantity', '$image')";

    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://classless.de/classless-tiny.css">
    <title>Add Product</title>
</head>
<body>
    <h1>Add New Product</h1>
    <form method="POST" action="add_product.php" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required><br>
        <textarea name="description" placeholder="Product Description" required></textarea><br>
        <input type="number" step="0.01" name="price" placeholder="Price" required><br>
        <input type="number" name="quantity" placeholder="Quantity" required><br>
        <input type="file" name="image" accept="image/*"><br>
        <button type="submit">Add Product</button>
    </form>
    <?php include 'footer.php'; ?>
</body>
</html>
