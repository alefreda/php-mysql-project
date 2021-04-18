<?php include('serverInserimentoAttrattiva.php') ?>


<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inserimento Attrattiva</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
      <h2>Scegli la tipologia di attrattiva che vuoi inserire</h2>
    </div>

    <form action="inserimentoAttrattiva.php" method="post" enctype='multipart/form-data'>
      <?php include('errors.php'); ?>
      <div class="input-group">
        <button type="submit" name="monumento" class="btn">Inserisci un monumento per la tua città</button>
      </div>
      <div class="input-group">
        <button type="submit" name="attivitaRicreativa" class="btn">Inserisci una attività ricreativa</button>
      </div

       <?php if (isset($_POST['monumento'])): ?>
        <div class="input-group">
          <label>Nome</label>
          <input type="text" name="nomeMonumento">
        </div>
        <div class="input-group">
          <label>Indirizzo</label>
          <input type="text" name="indirizzoMonumento">
        </div><div class="input-group">
          <label>Latitudine</label>
          <input type="number" name="latitudineMonumento">
        </div>
        <div class="input-group">
          <label>Longitudine</label>
          <input type="number" name="longitudineMonumento">
        </div>
        <div class="input-group">
          <label>Foto</label>
          <input type="file" name="fotoMonumento">
        </div>
        <div class="input-group">
          <label>Descrizione</label>
          <input type="text" name="descrizioneMonumento">
        </div>
        <div class="input-group">
          <label>Seleziona lo stato del Monumento</label>
          <select class="input-group" name="statoMonumento">
            <option value="visitabile">Visitabile</option>
            <option value="non visitabile">Non visitabile</option>
            <option value="visitabile gratuitamente">Visitabile gratuitamente</option>
          </select>
        </div>
        <div class="input-group">
          <button type="submit" name="inserisciMonumento" class="btn">Inserisci Monumento</button>
        </div>
      <?php endif; ?>

      <?php if (isset($_POST['attivitaRicreativa'])): ?>
        <div class="input-group">
          <label>Nome</label>
          <input type="text" name="nomeAttivita">
        </div>
        <div class="input-group">
          <label>Indirizzo</label>
          <input type="text" name="indirizzoAttivita">
        </div><div class="input-group">
          <label>Latitudine</label>
          <input type="number" name="latitudineAttivita">
        </div>
        <div class="input-group">
          <label>Longitudine</label>
          <input type="number" name="longitudineAttivita">
        </div>
        <div class="input-group">
          <label>Foto</label>
          <input type="file" name="fotoAttivita">
        </div>
        <div class="input-group">
          <label>Prezzo (in €)</label>
          <input type="text" name="prezzoAttivita">
        </div>
        <div class="input-group">
          <label>Orario Apertura</label>
          <input type="time" name="orarioAperturaAttivita">
        </div>
        <div class="input-group">
          <label>Orario Chiusura</label>
          <input type="time" name="orarioChiusuraAttivita">
        </div>
        <div class="input-group">
          <label>Seleziona il giorno di chiusura</label>
          <select class="input-group" name="chiusuraAttivita">
            <option value="lunedi">Lunedì</option>
            <option value="martedi">Martedì</option>
            <option value="mercoledi">Mercoledì</option>
            <option value="giovedi">Giovedì</option>
            <option value="venerdi">Venerdì</option>
            <option value="sabato">Sabato</option>
            <option value="domenica">Domenica</option>
          </select>
        </div>
        <div class="input-group">
          <button type="submit" name="inserisciAttivita" class="btn">Inserisci attivita ricreativa</button>
        </div>
      <?php endif; ?>
      <div>
        <p> <a href="index.php">Torna alla home</a> </p>
      </div>
    </form>
  </body>
</html>
