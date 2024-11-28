<?php
$title = 'Products - Online Shop';
include 'header.php';
include 'db.php';

$is_logged_in = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://classless.de/classless-tiny.css">
    <link rel="stylesheet" href="bg.css">
</head>
<body>

<main>
    <h2>Products</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Image</th>
            <?php if ($is_logged_in): ?>
                <th>Actions</th>
            <?php endif; ?>
        </tr>
        <?php
        $sql = "SELECT * FROM products"; // Ensure correct table name
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0):
            while ($product = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['description']) ?></td>
                    <td><?= number_format($product['price'], 2) ?></td>
                    <td><?= $product['quantity'] ?></td>
                    <td>
                        <?php if (!empty($product['image'])): ?>
                            <img src="<?= htmlspecialchars($product['image']) ?>" alt="Product Image" width="100">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <?php if ($is_logged_in): ?>
                        <td>
                            <a href="edit_product.php?id=<?= $product['id'] ?>">Edit</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endwhile;
        else: ?>
            <tr>
                <td colspan="<?= $is_logged_in ? 7 : 6 ?>">No products available.</td>
            </tr>
        <?php endif; ?>
    </table>

    <?php if ($is_logged_in): ?>
        <a href="add_product.php">Add New Product</a>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
