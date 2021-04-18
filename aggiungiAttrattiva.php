<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
session_start();
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inserisci Attrattiva</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
    	<h2>Inserisci Attrattiva</h2>
    </div>
    <div class="input-group">
      <?php
      $username = $_SESSION['username'];
      $citta = $_SESSION['citta'];
       ?>
      <form  action="aggiungiAttrattiva.php" method="post">


            <div class="input-group">
              <label>Seleziona il tuo percorso</label>
              <select class="input-group" name="percorso">
                <?php
                $res=mysqli_query($db, "SELECT nomePercorso FROM percorso WHERE creatorePercorso = '$username' ORDER BY nomePercorso ASC");
                while ($row=mysqli_fetch_assoc($res)) { ?>
                 <option><?php echo $row['nomePercorso']; ?></option>
               <?php } ?>
              </select>
            </div>


            <div class="input-group">
              <label>Seleziona l'attrattiva</label>
              <select class="input-group" name="attrattiva">
                <?php
                $res=mysqli_query($db, "SELECT nome FROM attrattiva WHERE citta = '$citta' ORDER BY nome ASC");
                while ($row=mysqli_fetch_assoc($res)) { ?>
                 <option><?php echo $row['nome']; ?></option>
               <?php } ?>
              </select>
            </div>

            <div class="input-group">
              <label>Inserisci la durata</label>
              <input type="time" name="durata">
            </div>

            <div class="input-group">
              <button type="submit" name="inserisciAlPercorso" class="btn">Inserisci attrattiva al percorso</button>
            </div>

            <?php
            if (isset($_POST['inserisciAlPercorso'])) {
              $nomePercorso = $_POST['percorso'];
              $nomeAttrattiva = $_POST['attrattiva'];
              $durata = $_POST['durata'];


              $queryAttrattivainPercorso = $db -> prepare("CALL popolaPercorso('$nomePercorso','$nomeAttrattiva','$durata', @res)");
              $queryAttrattivainPercorso -> execute();
              $queryAttrattivainPercorso = $db -> prepare("SELECT @res");
              $queryAttrattivainPercorso -> execute();
              $risultato = $queryAttrattivainPercorso -> fetch();

              $_SESSION['success'] = "Attrattiva inserita con successo!";
              header('location: index.php');

            }
             ?>

       <div>
         <p> <a href="index.php">Torna alla home</a> </p>
       </div>
      </form>
    </div>
  </body>
</html>
