<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="signup.css">
    <script src="forum.js"></script>
    <title>Signup</title>
</head>
<body id="signupBody">
    <?php   require "header.php"   ?>
    <div id="signupDiv">
        <h1>
            Signup
        </h1>
        <form onsubmit="return gestisciSignup(event)">
            <label>Nickname:</label>
            <input type="text" name="nickname" required>  <br><br>
            <label>Name:</label>
            <input type="text" name="nome" required> <span id="erroreNome"></span> <br><br>
            <label>Surname:</label>
            <input type="text" name="cognome" required> <span id="erroreCognome"></span> <br><br>
            <label>Gender:</label>
            <input type="radio" name="sesso" value="maschio" required>Male
            <input type="radio" name="sesso" value="femmina" required>Female <br><br>
            <label>Mail:</label>
            <input type="email" name="mail" required> <br><br>
            <label>Password:</label>
            <input type="password" name="passwordUtente" required> <br><br>
            <input type="submit" value="Invia" name="invia">
        </form><br><br>
        <div id="giaAccount">
            Already have an account?
            <a href="login.php">Signup</a> 
        </div>
    </div>


</body>
</html>