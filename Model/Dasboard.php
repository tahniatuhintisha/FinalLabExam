<?php
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: ../View/Login.php");
    exit();
}

// Retrieve the user role from the session
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Welcome to the Dashboard</h1>

<?php if ($userRole === 'customer'): ?>
    <h2>Admin Dashboard</h2>
    <p>You have access to the admin features.</p>
    <ul>
        <li><a href="../Admin/ViewUsers.php">View Users</a></li>
        <li><a href="../Admin/ManageSettings.php">Manage Settings</a></li>
    </ul>
<?php elseif ($userRole === 'user'): ?>
    <h2>User Dashboard</h2>
    <p>Here are your options:</p>
    <!-- Add user-specific content here -->
    <ul>
        <li><a href="../User/ViewProfile.php">View Profile</a></li>
        <li><a href="../User/EditProfile.php">Edit Profile</a></li>
    </ul>
<?php else: ?>
    <h2>Guest Dashboard</h2>
    <p>Please register or log in to access more features.</p>
<?php endif; ?>

<br>
<a href="../Controller/Logout.php">Logout</a>

</body>
</html>
