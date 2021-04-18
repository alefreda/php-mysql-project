<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
include('serverInvioMessaggio.php');
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Invia Messaggio</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
    	<h2>Invia Messaggio</h2>
    </div>
    <div class="input-group">
      <form  action="invioMessaggio.php" method="post">
        <?php include('errors.php'); ?>
        <label>Mittente: <?php echo $_SESSION['username']; ?></label>
        <div class="input-group">
          <label>Seleziona l'utente destinatario del messaggio</label>
          <select class="input-group" name="utenteDestinatario">
            <?php
            $res=mysqli_query($db, "SELECT username FROM utente ORDER BY username ASC");
            while ($row=mysqli_fetch_assoc($res)) { ?>
             <option><?php echo $row['username']; ?></option>
           <?php } ?>
         </select>
        </div>
        <div class="input-group">
          <label>Inserisci il Titolo del messaggio</label>
          <input type="text" name="titoloMessaggio">
        </div>
        <div class="input-group">
          <label>Seleziona la tipologia del messaggio</label>
          <select class="input-group" name="tipologia">
            <option value="pubblico">Pubblico</option>
            <option value="privato">Privato</option>
          </select>
        </div>
        <div class="input-group">
          <label>Scrivi il messaggio: </label>
          <textarea class="input-group" name="messaggio" rows="5" cols="40" maxlength="300"></textarea><br>
        </div>
       <button type="submit" name="inviaMessaggio" class="btn">Inserisci</button>
       <div>
         <p> <a href="index.php">Torna alla home</a> </p>
       </div>
      </form>
    </div>
  </body>
</html>
