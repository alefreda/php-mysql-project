<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
session_start();
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Viusalizza Attrattive</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body>
    <div class="header">
    	<h2>Ricerca Attrattiva</h2>
    </div>
    <div class="input-group">
      <form  action="visualizzaAttrattive.php" method="post">
        <label>Seleziona il nome della città che vuoi cercare: </label>
        <select class="input-group" name="nomeCitta">
          <?php
          $res=mysqli_query($db, "SELECT DISTINCT citta FROM attrattiva ORDER BY citta ASC");
          while ($row=mysqli_fetch_assoc($res)) { ?>
           <option><?php echo $row['citta']; ?></option>
         <?php } ?>
       </select>
       <button type="submit" name="ricercaCitta" class="btn">Cerca</button>
       <?php if (isset($_POST['ricercaCitta'])): ?>
         <?php $nomeCitta = $_POST['nomeCitta']; ?>
         <label>Seleziona l'attrattiva di <strong> <?php echo $nomeCitta; ?> </strong>che preferisci: </label>
         <select class="input-group" name="nomeAttrattiva">
           <?php
           $res=mysqli_query($db, "SELECT nome FROM attrattiva WHERE citta='$nomeCitta' ORDER BY nome ASC");
           while ($row=mysqli_fetch_assoc($res)) { ?>
            <option><?php echo $row['nome']; ?></option>
          <?php } ?>
        </select><br>
        <button type="submit" name="visualizzaAttrattiva" class="btn">Visualizza Attrattiva</button>
       <?php endif; ?>
       <?php if (isset($_POST['visualizzaAttrattiva'])) {
         $nomeAttrattiva = $_POST['nomeAttrattiva'];

         $queryInfoAttrattiva = ("CALL infoAttrattiva2('$nomeAttrattiva')");
         $query3 = mysqli_query($db, $queryInfoAttrattiva);
         $row2 = mysqli_fetch_assoc($query3);
         $indirizzo = $row2['indirizzo'];
         $latitudine = $row2['latitudine'];
         $longitudine = $row2['longitudine'];
         $foto = $row2['foto'];
         $citta = $row2['citta'];
         $prezzo = $row2['prezzo'];
         $tipologia = $row2['tipologia'];
         $_SESSION['nomeCittaAttrattiva'] = $citta;
         $_SESSION['nomeAttivitaMonumento'] = $nomeAttrattiva;
         ?>

         <br>
         <br>

         <?php
         echo 'La seguente attrattiva si trova a: <strong>'.$citta.'</strong><br>';
         echo 'Nome Attrattiva: <strong>'.$nomeAttrattiva.'</strong><br>';
         echo 'Indirizzo: <strong>'.$indirizzo.'</strong><br>';
         echo 'Latitudine: <strong>'.$latitudine.'</strong><br>';
         echo 'Longitudine: <strong>'.$longitudine.'</strong><br><br>';
         echo "Foto: <img alt=".$nomeAttrattiva." src=".$foto."  style='border-radius:5px;' height=200px width=300px/> <br><br>";
         echo 'Tipologia: <strong>'.$tipologia.'</strong><br>';

         if ($tipologia==='Attivita') {
           $prezzo = $row2['prezzo'];
           $orarioApertura = $row2['orarioApertura'];
           $orarioChiusura = $row2['orarioChiusura'];
           $giornoChiusura = $row2['giornoChiusura'];

           echo 'Prezzo €: <strong>'.$prezzo.'</strong><br>';
           echo 'Orario Apertura: <strong>'.$orarioApertura.'</strong><br>';
           echo 'Orario Chiusura: <strong>'.$orarioChiusura.'</strong><br>';
           echo 'Giorno di chiusura: <strong>'.$giornoChiusura.'</strong><br>';
         } else {
           $descrizione = $row2['descrizione'];
           $stato = $row2['stato'];
           echo 'Descrizione: <strong>'.$descrizione.'</strong><br>';
           echo 'Stato: <strong>'.$stato.'</strong><br>';

         }
         ?>
         <br>
         <input type="button" name="commenta" class="btn" onclick="location.href='commentaAttrattiva.php'" value="Commenta l'attrattiva"></input>
       <?php }?>
      <br><br><br><br><br>
      <div>
         <p><input type="button" name="home" class="btn" onclick="location.href='index.php'"  value="Torna alla Home"></input><br></p>
      </div>

      </form>
    </div>
  </body>
</html>
