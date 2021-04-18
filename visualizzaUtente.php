<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Visualizzazione utente</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
    	<h2>Ricerca Utente</h2>
    </div>
    <div class="input-group">
      <form  action="visualizzaUtente.php" method="post">
            <div class="input-group">
              <label>Seleziona lo username dell'utente</label>
              <select class="input-group" name="utente">
                <?php
                $res=mysqli_query($db, "SELECT username FROM utente WHERE tipologia != 'Gestore' ORDER BY username ASC");
                while ($row=mysqli_fetch_assoc($res)) { ?>
                 <option><?php echo $row['username']; ?></option>
               <?php } ?>
              </select>
              <button type="submit" name="cercaUtente" class="btn">Cerca Utente</input>
            </div>

            <!-- visualizza le informazioni relative all'utente scelto -->
            <?php if (isset($_POST['cercaUtente'])): ?>
              <div class="input-group">
                <?php $utente = $_POST['utente'];
                $queryInfoUtente = ("CALL infoUtente('$utente')");
                $query = mysqli_query($db,$queryInfoUtente);
                $row = mysqli_fetch_assoc($query);
                $email = $row['email'];
                $nascita = $row['dataNascita'];
                $residenza = $row['residenza'];
                $attrattive = $row['numeroAttrattiveInserite'];

                echo 'Username: <strong>'.$utente.'</strong><br>';
                echo 'Email: <strong>'.$email.'</strong><br>';
                echo 'Data di Nascita: <strong>'.$nascita.'</strong><br>';
                echo 'Residenza: <strong>'.$residenza.'</strong><br>';
                echo 'Numero attrattive inserite: <strong>'.$attrattive.'</strong><br>';
                 ?>
              </div>
            <?php endif; ?>
       <div>
         <p> <a href="index.php">Torna alla home</a> </p>
       </div>
      </form>
    </div>
  </body>
</html>
