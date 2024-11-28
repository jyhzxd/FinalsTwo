<?php


$title = 'Edit Product - Online Shop';
include 'header.php';
include 'db.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $product['image'];


    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";
        $image = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
            $image = $conn->real_escape_string($image);
        }
    }

    $sql = "UPDATE products SET 
            name = '$name', description = '$description', price = '$price', quantity = '$quantity', image = '$image' 
            WHERE id = $id";

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
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form method="POST" action="edit_product.php?id=<?= $id ?>" enctype="multipart/form-data">
        <input type="text" name="name" value="<?= $product['name'] ?>" required>
        <br><textarea name="description" required><?= $product['description'] ?></textarea>
        <br><input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required>
        <br><input type="number" name="quantity" value="<?= $product['quantity'] ?>" required>
        
        <?php if ($product['image']): ?>
            <p>Current Image:</p>
            <img src="<?= $product['image'] ?>" width="100">
        <?php endif; ?>
        <br><input type="file" name="image" accept="image/*">
        <br>
        <br><button type="submit">Update Product</button>
    </form>
    <?php include 'footer.php'; ?>
</body>
</html>