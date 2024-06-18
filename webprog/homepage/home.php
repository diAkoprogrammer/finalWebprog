<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homepage</title>
    <style>
	body {
    font-family: Arial, sans-serif;
    margin: 0;
}

.side-panel {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #3A3B3C;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}
.side-panel h1, p{
    color: azure;
}
.side-panel span{
    position: fixed;
    top: 2%;
    left: 2%;
}
.side-panel a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #C0C6C7;
    display: block;
    transition: 0.3s;
}

.side-panel a:hover {
    color: rgb(255, 255, 255);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.main-content {
    margin-left: 0;
    transition: margin-left 0.5s;
    padding: 16px;
}

.open-btn {
    font-size: 30px;
    cursor: pointer;
}

.hidden {
    display: none;
}
#logout{
    
    bottom: 0%;
    text-align: center;

}
img{
    height: 100px;
    width: 100px;
    border-radius: 50%;
    margin-left: 10%;
}
.userCred{
   
    color: white;
    margin-left: 10%;
}

	</style>
</head>

<body>

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

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, username FROM users WHERE username = ?");
    $stmt->bind_param("s", $_SESSION['username']);
    $stmt->execute();
    $stmt->bind_result($id, $username);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    ?>

    <div id="sidePanel" class="side-panel">
    <span class="open-btn" onclick="toggleSidePanel()" style="color:white;">&#9776;</span>
    <br>
        <img src="pic.png" alt="userImage">
            <h1>Welcome, <?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>!</h1>
   	    <p>Your ID: <?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?></p>

        <a href="#" onclick="showContent('home')">Home</a>
        <a href="#" onclick="showContent('about')">About</a>
		<a href="changeUname.html">Change User name</a>
        <a href="changePass.html">Change Password</a>
        <a href="#">Settings</a><br>
        <a href="logout.php" id="logout">Log out</a>
        
    </div>
    <div id="mainContent" class="main-content">
        <span class="open-btn" onclick="toggleSidePanel()" id="menuM">&#9776; Menu</span>
        <div id="content">
            <h2>Content here</h2>
			<hr>
            <p>dislay content here</p>
        </div>
    </div>
    <script>

	function toggleSidePanel() {
    var sidePanel = document.getElementById("sidePanel");
    var mainContent = document.getElementById("mainContent");
    if (sidePanel.style.width === "250px") {
        sidePanel.style.width = "0";
        mainContent.style.marginLeft = "0";
    } else {
        sidePanel.style.width = "250px";
        mainContent.style.marginLeft = "0";
    }
}

	function showContent(content) {
    var contentDiv = document.getElementById("content");
    if (content === 'home') {
        contentDiv.innerHTML = "<h2>Home</h2><p>temporary home display</p>";
    } else if (content === 'about') {
        contentDiv.innerHTML = "<h2>About</h2><p>temporary About display</p>";
    }
}


	</script>
</body>
</html>