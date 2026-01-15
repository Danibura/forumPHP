<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require "../config.php";
        extract($_POST);
        $sql="SELECT * FROM utenti WHERE mail='$mail'";
        $ris=$conn->query($sql);
        if($ris && $ris->num_rows>0){
            $row=$ris->fetch_assoc();
            $passwordDB=$row["passwordUtente"];
            if(password_verify($passwordUtente, $passwordDB))
            {
                $risposta=["success"=>true, "message"=>"Accesso effettuato correttamente"];
                session_start();
                $_SESSION["utente"]=$row;
            }
            else
                $risposta=["success"=>false, "message"=>"Password errata"];
        }
        else
            $risposta=["success"=>false, "message"=>"Email non trovata"];

        
        echo json_encode($risposta);
    }

?>