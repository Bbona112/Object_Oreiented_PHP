<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'User.php';

$user = new User();
$users = $user->getUsers();

if ($users) {
    echo "<h1>User List</h1>";
    echo "<p>Welcome, " . $_SESSION['username'] . "! <a href='logout.php'>Logout</a></p>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Username</th></tr>";

    foreach ($users as $userData) {
        echo "<tr>";
        echo "<td>{$userData['id']}</td>";
        echo "<td>{$userData['username']}</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No users found.";
}
?>
