<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="Style.css"> 
</head>
<body>
    <h1>Product List</h1>

    <?php if (!empty($products)): ?>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Description</th>
            </tr>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo htmlspecialchars($product['price']); ?></td>
                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No products available.</p>
    <?php endif; ?>

</body>
</html>
