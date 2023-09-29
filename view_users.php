<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'User.php';
require_once 'Database.php';


$user = new User();
$users = $user->getUsers();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <style>
       
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #333;
        }

        a {
            color: #333;
            text-decoration: none;
        }

        table {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border-collapse: collapse;
            box-shadow: 0px 0px 10px 0px #333;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        p {
            margin-top: 10px;
        }

        
        a.logout {
            color: #f00;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>User List</h1>
    <p>Welcome, <?php echo $_SESSION['username']; ?>! <a class="logout" href="logout.php">Logout</a></p>

    <?php
    if ($users) {
        echo "<table>";
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
</body>
</html>
