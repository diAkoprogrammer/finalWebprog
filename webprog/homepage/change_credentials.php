<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";


/*will edit this pag hihiwalayin yung form para less error kung sakale*/

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$new_username = isset($_POST['new_username']) ? trim($_POST['new_username']) : '';
$new_password = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';
$current_username = $_SESSION['username'];

$update_query = "UPDATE users SET ";
$params = [];
$types = "";

if (!empty($new_username)) {
    $update_query .= "username = ?, ";
    $params[] = $new_username;
    $types .= "s";
}
if (!empty($new_password)) {
    $hashed_password = md5($new_password, PASSWORD_DEFAULT);
    $update_query .= "password = ?, ";
    $params[] = $hashed_password;
    $types .= "s";
}

if (!empty($params)) {
    $update_query = rtrim($update_query, ", ") . " WHERE username = ?";
    $params[] = $current_username;
    $types .= "s";

    $stmt = $conn->prepare($update_query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        if (!empty($new_username)) {
            $_SESSION['username'] = $new_username;
        }
        echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";
    } else {
        echo "Failed to update credentials.";
    }
    $stmt->close();
} else {
    echo "Please fill in at least one field.";
}

$conn->close();
?>
