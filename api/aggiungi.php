<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        require "../config.php";
        extract($_POST);

        if(!isset($_SESSION["utente"]) || !isset($_SESSION["utente"]["ID_utente"])){
            $risposta=["success"=>false, "message"=>"User not authenticated"];
            echo json_encode($risposta);
            exit;
        }
        
        $idUtente=$_SESSION["utente"]["ID_utente"];
        if($idRisposta=="")
        {
            $sql="INSERT INTO messaggi(titolo, messaggio, id_utente) VALUES ('$titoloMessaggio', '$testoMessaggio', $idUtente)";
            $ris=$conn->query($sql);
                if(!$ris)
                    $risposta=["success"=>false, "message"=>"Error"];
                else
                    $risposta=["success"=>true, "message"=>"Success"];
            echo json_encode($risposta);
        }
        else
        {
            $sql="SELECT * FROM messaggi WHERE ID_messaggio=$idRisposta";
            $ris=$conn->query($sql);
            if($ris->num_rows>0){
                $sql="INSERT INTO messaggi(titolo, messaggio, id_utente, id_messaggioRisposta) VALUES ('$titoloMessaggio', '$testoMessaggio', $idUtente, $idRisposta)";
                $ris=$conn->query($sql);
                if(!$ris)
                    $risposta=["success"=>false, "message"=>"Error"];
                else
                    $risposta=["success"=>true, "message"=>"Success"];
                echo json_encode($risposta);
            }
            else
            {
                $risposta=["success"=>false, "message"=>"Response ID not found"];
                echo json_encode($risposta);
            }     
        }

        session_abort();
    }
?>