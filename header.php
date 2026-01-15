<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="header.css">
    <script src="forum.js"></script>
    <title>Document</title>
</head>
<body>
    <div id="header">
        <div>
            FORUM
        </div>
        <?php
            session_start();
            if(!isset($_SESSION["utente"]) || $_SESSION["utente"]=="")
            {
                echo "<a href='signup.php'>
                        <div class='material-icons-round' id='personaBottone'>
                            person
                        </div>
                    </a> ";
            }
            else
            {
                echo "<button class='material-icons-round' id='signout' onclick='signout()'>exit_to_app </button>";
            }

            session_abort();
        ?>
    </div>
</body>
</html>