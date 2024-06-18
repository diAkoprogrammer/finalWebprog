    <?php
    session_start(); // Start the session

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login_system";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        // Encrypt the password with MD5
        $password = md5($_POST['password']);

        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Set session variables
            $_SESSION["username"] = $username;
            echo "<script type='text/javascript'>alert('Login successful. Redirecting to home page...'); window.location.href = 'homepage/home.php';</script>";
        } else {
            echo "<script type='text/javascript'>alert('Invalid username or password.');</script>";
        }

        $stmt->close();
    }

    $conn->close();
    ?>
