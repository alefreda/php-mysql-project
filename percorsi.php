<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
session_start();
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Percorsi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="input-group">
      <div class="header">
      	<h2>Percorsi</h2>
      </div>
      <form action="percorsi.php" method="post">
        <div class="input-group">
          <label>Seleziona l'operazione da eseguire</label><br>
          <?php
          $tipo = $_SESSION['tipo'];
           ?>

           <?php if ($tipo === 'Premium'): ?>
             <input type="button" name="creaPercorso" class="btn" onclick="location.href='creazionePercorso.php'"  value="Crea un nuovo percorso per la tua città"></input><br><br>
             <input type="button" name="aggiungiAttrattivaPercorso" class="btn" onclick="location.href='aggiungiAttrattiva.php'"  value="Aggiungi una attrattiva al tuo percorso"></input><br><br>
           <?php endif; ?>
          <input type="button" name="visualizzaPercorso" class="btn" onclick="location.href='visualizzaPercorsi.php'"  value="Visualizza i percorsi"></input><br><br>
          <input type="button" name="composizionePercorso" class="btn" onclick="location.href='composizionePercorso.php'"  value="Visualizza le mete di un percorso"></input><br><br>
        </div>
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
