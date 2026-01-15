<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="login.css">
    <script src="forum.js"></script>
    <title>Document</title>
</head>
<body id="loginBody">
    
    <?php   require "header.php"   ?>
    <div id="loginDiv">
        <h1>
            Login
        </h1>
        <form onsubmit="return gestisciLogin(event)">
            <label>Mail:</label>
            <input type="email" name="mail" required> <br><br>
            <label>Password:</label>
            <input type="password" name="passwordUtente" required> <br><br>
            <input type="submit" value="Invia" name="invia">
        </form><br><br>
        <div id="noAccount">
            Don't have an account yet?
            <a href="signup.php">Register</a>
        </div>
    </div>
</body>
</html>