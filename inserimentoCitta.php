<?php include('serverRegistrazione.php')

 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inserisci Città</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
    	<h2>Aggiungi Città</h2>
    </div>

  <form method="post" action="inserimentoCitta.php">
    	<?php include('errors.php'); ?>
    <div class="input-group">
      <label>Nome</label>
      <input type="text" name="nomeCitta">
    </div>
    <div class="input-group">
      <label>Regione</label>
      <input type="text" name="regioneCitta">
    </div>
    <div class="input-group">
      <label>Stato</label>
      <input type="text" name="statoCitta">
    </div>
    <div class="input-group">
      <label>Foto</label>
      <input type="file" name="fotoCitta">
    </div>
    <div class="input-group">
      <button type="submit" name="aggiungiCitta" class="btn">Inserisci</button>
    </div>
  </from>
  </body>
</html>
