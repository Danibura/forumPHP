<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        require "../config.php";
        extract($_POST);

        $sql="UPDATE messaggi SET titolo='$titolo', messaggio='$messaggio' WHERE ID_messaggio=$ID_messaggio";
        $ris=$conn->query($sql);
        if(!$ris)
            $risposta=["success"=>false, "message"=>"Errore durante la modifica del messaggio"];
        else
            $risposta=["success"=>true, "message"=>"Messaggio modificato correttamente"];
        echo json_encode($risposta);
        session_abort();
    }
?>