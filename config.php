<?php
    $host="sql102.infinityfree.com";
    $user="if0_40906280";
    $psw="Aledan2404";
    $db="if0_40906280_forum";
    $conn= new mysqli($host, $user, $psw, $db);
    if(mysqli_connect_errno())
    {
        $risposta=["success"=>false, "message"=>"Connection error"];
        echo json_encode($risposta);
        exit;
    }

?>