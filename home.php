<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="areaRiservata.css">
</head>
<body>
    <?php
        require "header.php";
    ?>
    <div id="content">
        <h1 id="titolo">Home</h1>
            <div id="spazioSotto">
            <div>
                <h2 id="titoloMU">Messaggi degli utenti</h2>
                <?php
                    require "config.php";
                    extract($_GET);

                    $sql="SELECT * FROM messaggi 
                    LEFT JOIN utenti ON messaggi.id_utente = utenti.ID_utente 
                    ORDER BY dataMessaggio DESC, ora DESC";

                    $ris=$conn->query($sql);
                    if($ris->num_rows>0){
                        while($row=$ris->fetch_assoc()){
                            if((!isset($sesso) || $sesso=="" || $row["sesso"]==$sesso)
                                && (!isset($dataInizio) || $dataInizio=="" || $row["dataMessaggio"]>=$dataInizio)
                                && (!isset($dataFine) || $dataFine=="" || $row["dataMessaggio"]<=$dataFine)
                                && (!isset($nickname) || $nickname=="" || $row["nickname"]==$nickname)
                            )
                            {
                                $convertiDataR=strtotime($row["dataRegistrazione"]);
                                $dataR=date("d-m-Y", $convertiDataR);
                                $convertiOraM=strtotime($row["ora"]);
                                $oraM=date("H:i", $convertiOraM);
                            echo "<div class='m' id='m" . $row["ID_messaggio"] . "'>
                                        <div class='idSopra'>
                                            <div> ID messaggio: " . $row["ID_messaggio"] . " </div> ";
                                            if(isset($row["id_messaggioRisposta"])) echo "<div> Risposta ad ID: " . $row["id_messaggioRisposta"] . " </div> ";
                            echo "</div>
                                <div class='intestazione'>
                                <div> " . $row["nickname"] .  " " . $row["sesso"] . " " . $dataR . "</div>
                                <div> " . $row["dataMessaggio"] . " " . $oraM . "</div>
                                </div>
                                    <textarea class='titoloM' readonly>" . $row["titolo"] . "</textarea>
                                    <textarea class='testoM' readonly>" . $row["messaggio"] . "</textarea> 
                                </div>";
                            }
                        }
                    }
                ?>
            </div>
            <div id="filtri">
                <h2>Filtra per:</h2>
                <form action="home.php" method="GET">
                    Sesso:
                    <input type="radio" name="sesso" value="maschio">Maschio
                    <input type="radio" name="sesso" value="femmina">Femmina
                    <br> <br>
                    Data inizio:
                    <input type="date" name="dataInizio"> <br> <br>
                    Data fine:
                    <input type="date" name="dataFine"> <br> <br>
                    Nickname: 
                    <input type="text" name="nickname"> <br> <br>
                    <button type="submit">Applica filtri</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>