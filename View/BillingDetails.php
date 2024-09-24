<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Details</title>
    <link rel="stylesheet" href="Style.css"> <!-- Assuming Style.css is for styling -->
</head>
<body>
    <h1>Billing Details</h1>
    <p>User ID: <?php echo $billing['user_id']; ?></p>
    <p>Total Amount: <?php echo $billing['total_amount']; ?></p>
    <p>Date: <?php echo $billing['date']; ?></p>
</body>
</html>