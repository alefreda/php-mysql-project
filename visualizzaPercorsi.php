<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
session_start();
$tipo = $_SESSION['tipo'];
$username = $_SESSION['username'];

if (isset($_POST['aggiungiPreferiti'])) {
  $nomePercorso = $_POST['percorso'];

  $queryPreferiti = $db -> prepare("CALL aggiungiPreferito('$nomePercorso','$username', @res)");
  $queryPreferiti -> execute();
  $queryPreferiti = $db -> prepare("SELECT @res");
  $queryPreferiti -> execute();
  $risultato = $queryPreferiti -> fetch();

  $_SESSION['success'] = "Percorso aggiunto ai preferiti";
  header('location: index.php');
}

 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Viusalizza Percorsi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
    	<h2>Ricerca Percorso</h2>
    </div>
    <div class="input-group">
      <form  action="visualizzaPercorsi.php" method="post">
            <div class="input-group">
              <label>Seleziona il percorso</label>
              <select class="input-group" name="percorso">
                <?php
                $res=mysqli_query($db, "SELECT nomePercorso FROM percorso ORDER BY nomePercorso ASC");
                while ($row=mysqli_fetch_assoc($res)) { ?>
                 <option><?php echo $row['nomePercorso']; ?></option>
               <?php } ?>
              </select>
              <button type="submit" name="cercaPercorso" class="btn">Cerca percorso</input>
            </div>
            <?php if (isset($_POST['cercaPercorso'])): ?>
              <div class="input-group">
                <?php $percorso = $_POST['percorso'];
                $queryInfoPercorso = ("CALL infoPercorso('$percorso')");
                $query = mysqli_query($db,$queryInfoPercorso);
                $row = mysqli_fetch_assoc($query);
                $categoria = $row['categoria'];
                $durata = $row['durata'];
                $citta = $row['citta'];
                $creatore = $row['creatorePercorso'];

                echo 'Creato da: <strong>'.$creatore.'</strong><br>';
                echo 'Nome del percorso: <strong>'.$percorso.'</strong><br>';
                echo 'Categoria: <strong>'.$categoria.'</strong><br>';
                echo 'Città: <strong>'.$citta.'</strong><br>';
                echo 'Durata: <strong>'.$durata.'</strong><br>';
                 ?>
                 <?php if ($tipo === 'Premium'): ?>
                   <br><button type="submit" name="aggiungiPreferiti" class="btn">Aggiungi ai preferiti</button>
                 <?php endif; ?>
              </div>
            <?php endif; ?>
       <div>
         <p> <a href="index.php">Torna alla home</a> </p>
       </div>
      </form>
    </div>
  </body>
</html>
