<!DOCTYPE html>
<html lang="en">

<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebBook</title>
<head>
<style>
	
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        background-color:#3A3B3C;
    }
    
    #loginPopup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        backdrop-filter: blur(5px); /* Blur effect */
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }
    
    .popup-content {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        width: 300px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        position: relative;
    }
    
    #openLoginForm {
        margin: 10%;
    }
    
    button {
        cursor: pointer;
        background-color:white;
        
        
    }
    
    .logButton{
        height: 80px;
        width: 160px;
        border-radius: 5%;
    }
    :hover.logButton{
        
        width: 163px;
        background-color: whitesmoke ;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
    .a{
        color:  #C0C6C7;
    }
    :hover.a{
        color: azure;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
        </style>
    
</head>
<body>
    

    <button id="openLoginForm" class="logButton">Log In</button>
    <br>
    <a href="registration.html" class="a">Register</a>

    <div id="loginPopup" class="popup">
        <div class="popup-content" id="loginForm">
            <h2>Login</h2>
            <form action="login.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <br><br>
                <button type="submit" value="Login">Submit</button>
            </form>
        </div>
    </div>
    
    </body>
    
    <script>
	document.addEventListener('DOMContentLoaded', (event) => {
    const loginPopup = document.getElementById('loginPopup');
    const loginForm = document.getElementById('loginForm');
    const openLoginFormButton = document.getElementById('openLoginForm');

    openLoginFormButton.addEventListener('click', () => {
        loginPopup.style.display = 'flex';
    });

    window.addEventListener('click', (event) => {
        if (event.target == loginPopup) {
            loginPopup.style.display = 'none';
        }
    });
});
	
	</script>
</html>
