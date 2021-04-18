<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Viusalizza Gestore</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
    	<h2>Ricerca Gestore</h2>
    </div>
    <div class="input-group">
      <form  action="visualizzaGestore.php" method="post">
            <div class="input-group">
              <label>Seleziona lo username del gestore</label>
              <select class="input-group" name="gestore">
                <?php
                $res=mysqli_query($db, "SELECT username FROM gestore ORDER BY username ASC");
                while ($row=mysqli_fetch_assoc($res)) { ?>
                 <option><?php echo $row['username']; ?></option>
               <?php } ?>
              </select>
              <button type="submit" name="cercaGestore" class="btn">Cerca Gestore</input>
            </div>
            <?php if (isset($_POST['cercaGestore'])): ?>
              <div class="input-group">
                <?php $utente = $_POST['gestore'];
                $queryInfoGestore = ("CALL infoGestore('$utente')");
                $query = mysqli_query($db,$queryInfoGestore);
                $row = mysqli_fetch_assoc($query);
                $email = $row['email'];
                $nascita = $row['dataNascita'];
                $residenza = $row['residenza'];

                $attivita = $row['nomeAttivita'];
                $indirizzo = $row['indirizzo'];
                $telefono = $row['telefono'];
                $sitoweb = $row['sitoWeb'];

                echo 'Username: <strong>'.$utente.'</strong><br>';
                echo 'Email: <strong>'.$email.'</strong><br>';
                echo 'Data di Nascita: <strong>'.$nascita.'</strong><br>';
                echo 'Residenza: <strong>'.$residenza.'</strong><br>';
                echo 'Nome Attività: <strong>'.$attivita.'</strong><br>';
                echo 'Indirizzo: <strong>'.$indirizzo.'</strong><br>';
                echo 'Sito Web: <strong>'.$sitoweb.'</strong><br>';
                echo 'Recapito: <strong>'.$telefono.'</strong><br>';

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
