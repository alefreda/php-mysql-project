<?php include('serverCommentaAttrattiva.php'); ?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inserisci Commento</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
    	<h2>Aggiungi Commento per la seguente attrattiva: <?php echo $_SESSION['nomeAttivitaMonumento']; ?></h2>
    </div>
  <form method="post" action="commentaAttrattiva.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
      <label>Inserisci un commento:</label>
      <textarea class="input-group" name="commento" rows="5" cols="40" maxlength="200"></textarea><br>
    </div>
    <div class="input-group">
      <label>Vota l'attrattiva:</label>
      <select class="input-group" name="voto">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
    </div>
  </from>
    <button type="submit" name="inviaCommento" class="btn">Inserisci commento</button>
  </body>
</html>
