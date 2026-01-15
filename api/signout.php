<?php
    session_start();
    session_unset();
    $ris= ["success"=>true, "message"=>"Signout svolto correttamente"];
    echo json_encode($ris);
?>