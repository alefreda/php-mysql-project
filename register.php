<?php include('serverRegistrazione.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registrazione</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Registrati</h2>
  </div>
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
      <div class="input-group">
        <button type="submit" name="gestore" class="btn">Gestore
        <button type="submit" name="semplice" class="btn">Semplice
      </div>
      <?php if (isset($_POST['semplice'])): ?>
        <div class="input-group">
      	  <label>Residenza</label><strong><?php echo "(Se la città non è presente, clicca \"Aggiungi città\" per aggiungere una nuova città)"; ?></strong><br>
          <select class="input-group" name="residenza">
            <?php
            $res=mysqli_query($db, "SELECT nome FROM citta ORDER BY nome ASC");
            while ($row=mysqli_fetch_assoc($res)) { ?>
             <option><?php echo $row['nome']; ?></option>
           <?php } ?>
          </select>
          <div class="input-group">
            <button type="button" name="reg_citta" class="btn"> <a href="inserimentoCitta.php">Aggiungi Città</a></button>
          </div>
      	</div>
        <div class="input-group">
      	  <label>Nome Utente</label>
      	  <input type="text" name="username" value="<?php echo $username; ?>">
      	</div>
      	<div class="input-group">
      	  <label>Email</label>
      	  <input type="email" name="email" value="<?php echo $email; ?>">
      	</div>
      	<div class="input-group">
      	  <label>Password</label>
      	  <input type="password" name="password_1">
      	</div>
      	<div class="input-group">
      	  <label>Conferma password</label>
      	  <input type="password" name="password_2">
      	</div>
        <div class="input-group">
      	  <label>Data di Nascita</label>
      	  <input type="date" name="data_nascita">
      	</div>
        <div class="input-group">
          <button type="submit" class="btn" name="reg_user">Registra Utente Semplice</button>
        </div>

      <?php endif; ?>
      <?php if (isset($_POST['gestore'])): ?>
        <div class="input-group">
      	  <label>Residenza</label><strong><?php echo "(Se la città non è presente, clicca \"Aggiungi città\" per aggiungere una nuova città)"; ?></strong><br>
          <select class="input-group" name="residenza">
            <?php
            $res=mysqli_query($db, "SELECT nome FROM citta ORDER BY nome ASC");
            while ($row=mysqli_fetch_assoc($res)) { ?>
             <option><?php echo $row['nome']; ?></option>
           <?php } ?>
          </select>
          <div class="input-group">
            <button type="button" name="reg_citta" class="btn"> <a href="inserimentoCitta.php">Aggiungi Città</a></button>
          </div>
      	</div>
        <div class="input-group">
          <label>Nome Utente</label>
          <input type="text" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="input-group">
          <label>Email</label>
          <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="input-group">
          <label>Password</label>
          <input type="password" name="password_1">
        </div>
        <div class="input-group">
          <label>Conferma password</label>
          <input type="password" name="password_2">
        </div>
        <div class="input-group">
          <label>Data di Nascita</label>
          <input type="date" name="data_nascita">
        </div>
          <div class="input-group">
            <label>Nome Attività</label>
            <input type="text" name="attivita">
          </div>
          <div class="input-group">
            <label>Indirizzo (Via)</label>
            <input type="text" name="indirizzo">
          </div>
          <div class="input-group">
            <label>Recapito</label>
            <input type="text" name="recapito">
          </div>
          <div class="input-group">
            <label>Sito Web</label>
            <input type="text" name="sitoweb">
          </div>
          <div class="input-group">
            <button type="submit" class="btn" name="reg_gestore">Registra Gestore</button>
          </div>
      <?php endif; ?>
  	<p>
  		Sei già registrato? <a href="login.php">Entra</a>
  	</p>
  </form>
</body>
</html>
