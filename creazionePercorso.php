<?php
include('serverCreazionePercorso.php');
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Crea un percorso</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
      <h2>Crea un percorso</h2>
    </div>

    <form action="creazionePercorso.php" method="post">
        <?php include('errors.php'); ?>
        <div class="input-group">
          <label>Nome del percorso: </label>
          <input type="text" name="nomePercorso">
        </div>

        <div class="input-group">
          <label>Seleziona la categoria del percorso: </label>
          <select class="input-group" name="categoria">
            <option value="arte">Arte</option>
            <option value="storia">Storia</option>
            <option value="nautura">Natura</option>
            <option value="gastronomico">Gastronomico</option>
            <option value="relax">Relax</option>
            <option value="misto">Misto</option>
          </select>
        </div>

        <div class="input-group">
          <label>Durata del percorso: </label>
          <input type="time" name="durataPercorso">
        </div><br>

        <div class="input-group">
          <button type="submit" name="creaPercorso" class="btn">Crea Percorso</button>
        </div>


    <div>
      <p> <a href="index.php">Torna alla home</a> </p>
    </div>
  </form>
</body>
</html>
