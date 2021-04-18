<?php include('serverInserimentoEvento.php') ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inserimento Evento</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
      <h2>Inserisci il tuo evento</h2>
    </div>

    <form action="inserimentoEvento.php" method="post">
      <?php include('errors.php'); ?>

        <div class="input-group">
          <label>Titolo Evento</label>
          <input type="text" name="titoloEvento">
        </div>

        <div class="input-group">
          <label>Descrizione dell'Evento: </label>
          <textarea class="input-group" name="descrizioneEvento" rows="5" cols="40" maxlength="200"></textarea><br>
        </div>

        <div class="input-group">
          <label>Data</label>
          <input type="date" name="dataEvento">
        </div>

        <div class="input-group">
          <label>Orario di Inizio</label>
          <input type="time" name="orarioEvento">
        </div>

        <div class="input-group">
          <label>Numero massimo di partecipanti</label>
          <input type="text" name="numeroPartecipanti">
        </div>

        <div class="input-group">
          <label>Seleziona lo stato dell'evento</label>
          <select class="input-group" name="stato">
            <option value="aperto">Aperto</option>
            <option value="chiuso">Chiuso</option>
          </select>
        </div>

        <div class="input-group">
          <button type="submit" name="inserisciEvento" class="btn">Inserisci Evento</button>
        </div>

    <div>
      <p> <a href="index.php">Torna alla home</a> </p>
    </div>
  </form>
</body>
</html>
