<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
session_start();
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Viusalizza Eventi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
    	<h2>Ricerca Evento</h2>
    </div>
    <div class="input-group">
      <form  action="visualizzaEventi.php" method="post">
        <label>Seleziona il nome della città che vuoi cercare: </label>
        <select class="input-group" name="nomeCitta">
          <?php
          $res=mysqli_query($db, "SELECT DISTINCT citta FROM evento ORDER BY citta ASC");
          while ($row=mysqli_fetch_assoc($res)) { ?>
           <option><?php echo $row['citta']; ?></option>
         <?php } ?>
       </select><br>
       <button type="submit" name="ricercaCitta" class="btn">Cerca</button>
       <?php if (isset($_POST['ricercaCitta'])): ?>
         <?php $nomeCitta = $_POST['nomeCitta']; ?>
         <label>Seleziona l'evento di <strong> <?php echo $nomeCitta; ?></strong></label>
         <select class="input-group" name="nomeEvento">
           <?php
           $res=mysqli_query($db, "SELECT titolo FROM evento WHERE citta='$nomeCitta' ORDER BY titolo ASC");
           while ($row=mysqli_fetch_assoc($res)) { ?>
            <option><?php echo $row['titolo']; ?></option>
          <?php } ?>
        </select><br>
        <button type="submit" name="visualizzaEvento" class="btn">Visualizza Evento</button>
       <?php endif; ?>
       <?php if (isset($_POST['visualizzaEvento'])) {
         $_SESSION['evento'] = $_POST['nomeEvento'];
         $nomeEvento = $_SESSION['evento'];

         $queryInfoEvento = ("CALL infoEvento('$nomeEvento')");
         $query3 = mysqli_query($db, $queryInfoEvento);
         $row2 = mysqli_fetch_assoc($query3);
         $organizzatore = $row2['nomeOrganizzatore'];
         $_SESSION['attivita'] = $row2['nomeAttivita'];
         $attivita = $_SESSION['attivita'];
         $descrizione = $row2['descrizione'];
         $data = $row2['dataEvento'];
         $orario = $row2['orarioInizio'];
         $numPart = $row2['numeroPartecipanti'];
         $stato = $row2['stato'];
         ?>

         <br>
         <br>

         <?php
         echo 'Titolo: <strong>'.$nomeEvento.'</strong><br>';
         echo 'Nome Organizzatore: <strong>'.$organizzatore.'</strong><br>';
         echo 'Nome Attivita: <strong>'.$attivita.'</strong><br>';
         echo 'Descrizione: <strong>'.$descrizione.'</strong><br>';
         echo 'Data: <strong>'.$data.'</strong><br>';
         echo 'Orario: <strong>'.$orario.'</strong><br>';
         echo 'Stato: <strong>'.$stato.'</strong><br>';

         if ($stato==='Chiuso') {
           echo '<br><strong>Non puoi partecipare a questo evento, i posti sono terminati</strong>';
         }?>

         <?php if ($stato==='Aperto'): ?>
          <br> <button type="submit" name="iscriviti" class="btn">Partecipa all'evento!</button>
         <?php endif; ?>
      <?php }
       if (isset($_POST['iscriviti'])) {
         $nomeUtente = $_SESSION['username'];
         $nomeEvento = $_SESSION['evento'];
         $nomeAttivita = $_SESSION['attivita'];

         $queryPartecipazione = $db -> prepare("CALL partecipaEvento('$nomeEvento','$nomeUtente','$nomeAttivita', @res)");
         $queryPartecipazione -> execute();
         $queryPartecipazione = $db -> prepare("SELECT @res");
         $queryPartecipazione -> execute();
         $risultato = $queryPartecipazione -> fetch();

         $_SESSION['success'] = "Iscrizione Effettuata";
         header('location: index.php');
       }
      ?>
      <div>
         <p><input type="button" name="home" class="btn" onclick="location.href='index.php'"  value="Torna alla Home"></input><br></p>
      </div>

      </form>
    </div>
  </body>
</html>
