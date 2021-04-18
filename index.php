<?php
session_start();
  $db = mysqli_connect('localhost', 'root', '', 'seemycity');

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "Devi prima effettuare il login";
  	header('location: login.php');
  }

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>See My City</h2>
</div>
<div class="content">
  	<?php if (isset($_SESSION['success'])) : ?>

      <div class="error success" >
      	<h3>
          <?php
          	echo $_SESSION['success'];
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <?php
    if (isset($_SESSION['username'])) {
      $username = $_SESSION['username'];
      $queryInfoUtente = ("SELECT * FROM utente WHERE username='$username'");
      $query2 = mysqli_query($db, $queryInfoUtente);
      $row1 = mysqli_fetch_assoc($query2);
      $_SESSION['tipo'] = $row1['tipologia'];
      $_SESSION['citta'] = $row1['residenza'];
      $tipologia = $_SESSION['tipo'];
      if ($tipologia === 'Premium') {
        $queryInsPremium = $db -> prepare("CALL insPremium('$username', @res)");
        $queryInsPremium -> execute();
        $queryInsPremium = $db -> prepare("SELECT @res");
        $queryInsPremium -> execute();
        $risultato = $queryInsPremium -> fetch();
      }
      echo 'Benvenuto: <strong>'. $_SESSION['username'].'</strong><br>';
      echo 'Sei un utente di tipo: <strong>'.$_SESSION['tipo'].'</strong><br>';
      echo 'Residente a: <strong>'.$_SESSION['citta'].'</strong><br>';
      if ($tipologia==='Gestore') {
        $queryInfoGestore = ("SELECT * FROM gestore WHERE username='$username'");
        $query4=mysqli_query($db,$queryInfoGestore);
        $row = mysqli_fetch_assoc($query4);
        $_SESSION['nomeAttivita'] = $row['nomeAttivita'];
        echo 'La tua attività si chiama: <strong>'.$_SESSION['nomeAttivita'].'</strong><br>';

      }
    }
     ?>
     <div class="input-group">
       
       <input type="button" name="button" class="btn" onclick="location.href='areaPubblica.php'"  value="Area Pubblica"></input><br><br>
       <input type="button" name="button" class="btn" onclick="location.href='areaPrivata.php'"  value="Area Privata"></input><br><br>
       <input type="button" name="button" class="btn" onclick="location.href='areaAttrattive.php'"  value="Area Attrattive"></input><br><br>
       <input type="button" name="button" class="btn" onclick="location.href='areaEventi.php'" value="Area Eventi"></input><br><br>
       <input type="button" name="button" class="btn" onclick="location.href='areaStatistiche.php'" value="Area Statistiche"></input><br><br>
       <input type="button" name="button" class="btn" onclick="location.href='percorsi.php'" value="Area Percorsi"></input><br><br>

     </div>

    <p> <a href="index.php?logout='1'" style="color: black;">Logout</a> </p>
  </div>
</body>
</html>
