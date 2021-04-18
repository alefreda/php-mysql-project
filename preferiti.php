<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
session_start();
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Preferiti</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="input-group">
      <div class="header">
      	<h2>Preferiti</h2>
      </div>
      <form action="preferiti.php" method="post">
        <div class="input-group">
          <label>Questi sono i tuoi percorsi preferiti: </label><br>
        </div>

        <?php
        $username = $_SESSION['username'];

        $queryPreferiti = ("CALL listaPreferiti('$username')");
        $query = mysqli_query($db, $queryPreferiti);
        $count = 0;
        while ($row=mysqli_fetch_assoc($query)) {
          $count++;
          $nomePercorso = $row['nomePercorso'];
          echo 'Nome del Percorso: <strong>'.$nomePercorso.'</strong><br>';
      }
      if ($count==0) {
        echo 'Non hai preferiti';
      }
         ?>




        <br>
        <br>
        <br>
        <div>
           <p><input type="button" name="home" class="btn" onclick="location.href='index.php'"  value="Torna alla Home"></input><br></p>
        </div>
      </form>
    </div>
  </body>
</html>
