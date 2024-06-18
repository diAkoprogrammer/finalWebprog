<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login_system";

$conn = new mysqli($servername, $username, $password, $dbname);
//
//
/*add new server side dito para dun sa new parameters*/ 
//
//
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    // Encrypt the password with MD5
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        // Show success message and redirect to login page
        echo "<script type='text/javascript'>alert('Registration successful. Redirecting to login page...'); window.location.href = 'index.php';</script>";
    } else {
        // Use JavaScript alert for error message
        echo "<script type='text/javascript'>alert('Error: " . $stmt->error . "'); window.location.href = 'registration.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
