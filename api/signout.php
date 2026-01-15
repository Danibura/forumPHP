<?php
    session_start();
    session_unset();
    $ris= ["success"=>true, "message"=>"Signout successful"];
    echo json_encode($ris);
?>