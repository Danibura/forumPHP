    <?php   
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            require "../config.php";
            extract($_POST);

            $sql="SELECT * FROM utenti WHERE nickname='$nickname'";
            $ris=$conn->query($sql);
            if($ris->num_rows>0){
                $risposta=["success"=>false, "message"=>"Nickname gia in uso"];
                echo json_encode($risposta);
                exit;
            }

            $sql="SELECT * FROM utenti WHERE mail='$mail'";
            $ris=$conn->query($sql);
            if($ris->num_rows>0){
                $risposta=["success"=>false, "message"=>"Mail gia in uso"];
                echo json_encode($risposta);
                exit;
            }

            $passwordCriptata=password_hash($passwordUtente, PASSWORD_BCRYPT);
            $sql="INSERT INTO utenti(nickname, nome, cognome, sesso, mail, passwordUtente, privilegio) VALUES('$nickname', '$nome', '$cognome', '$sesso', '$mail', '$passwordCriptata', 1)";
            $ris=$conn->query($sql);
            if(!$ris)
                $risposta=["success"=>false, "message"=>"Errore durante la registrazione"];
            else
                $risposta=["success"=>true, "message"=>"Registrazione avvenuta con successo"];
            echo json_encode($risposta);     
        }
    ?>