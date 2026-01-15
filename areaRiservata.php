<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area riservata</title>
    <link rel="stylesheet" type="text/css" href="areaRiservata.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <script src="forum.js"></script>
</head>
<body>
    <?php require "header.php"   ?>
    <div id="content">
        <h1 id="titolo">Reserved area</h1>
        <form onsubmit="aggiungiMessaggio(event)">
            <div id="divAggiungi">
                <input type="text" placeholder="Titolo" id="titoloMessaggio" name="titoloMessaggio">
                <textarea  placeholder="Inserisci il tuo messaggio" id="testoMessaggio" name="testoMessaggio"></textarea>
                <div id="divRisposta">
                    <h2>Response: </h2>
                    <input type="number" id="risposta" name="idRisposta">
                </div>
                <button type="submit" id="inviaMes">Add a message</button>
            </div>
        </form> 
        <div id="spazioSotto">
            <div>
            <h2 id="titoloMU">User's messages</h2>
            <?php
                session_start();
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
                            <div class='intestazione'>";
                            if($_SESSION["utente"]["privilegio"]==1)
                                echo " <div> " . $row["nickname"] .  " " . $row["sesso"] . " " . $dataR . "</div>";
                            else
                                echo "<div> ". $row["nickname"] . " " . $row["nome"] . " " . $row["cognome"] . " " . $row["mail"] . " " . $dataR . "</div>";

                            echo "<div> " . $row["dataMessaggio"] . " " . $oraM . "</div>
                            </div>
                                <textarea class='titoloM' readonly>" . $row["titolo"] . "</textarea>
                                <textarea class='testoM' readonly>" . $row["messaggio"] . "</textarea>";

                            echo "<div class='bottoniM'>";
                            if($row["id_utente"]==$_SESSION["utente"]["ID_utente"])
                            {       
                                echo "<button class='modificaM' onclick='modificaMessaggio(" . $row["ID_messaggio"] . ")'>
                                            <img src='img/matita.png' alt='Modifica' width='20' />
                                        </button>

                                        <button class='okM' onclick='okMessaggio(" . $row["ID_messaggio"] . ")' hidden>
                                            <img src='img/ok.png' alt='Ok' width='20' />
                                        </button>";
                            }

                            if($row["id_utente"]==$_SESSION["utente"]["ID_utente"] || $_SESSION["utente"]["nickname"]=="admin")
                            {    
                                echo "<button class='eliminaM' onclick='eliminaMessaggio(" . $row["ID_messaggio"] . ")'>
                                            <img src='img/delete.png' alt='Elimina' width='20' />
                                        </button>";
                                    
                            }

                            echo "</div>
                            </div>";  
                            
                        }

                    }
                }
                session_abort();
            ?>
            </div>
            <div id="filtri">
                <h2>Filter by:</h2>
                <form action="areaRiservata.php" method="GET">
                    Gender:
                    <input type="radio" name="sesso" value="maschio">Male
                    <input type="radio" name="sesso" value="femmina">Female
                    <br> <br>
                    First date:
                    <input type="date" name="dataInizio"> <br> <br>
                    Last date:
                    <input type="date" name="dataFine"> <br> <br>
                    Nickname: 
                    <input type="text" name="nickname"> <br> <br>
                    <button type="submit">Apply filters</button>
                </form>
            </div>


        </div>
    </div>

</body>
</html>