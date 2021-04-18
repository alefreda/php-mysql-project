<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
session_start();
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Aggiungi Attrattiva</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
    	<h2>Seleziona l'Attrattiva</h2>
    </div>
    <div class="input-group">
      <form  action="aggiungiAttrattiva.php" method="post">
        <div class="input-group">
          <label>Seleziona il percorso</label>
          <?php
          $citta = $_SESSION['citta'];
          $username = $_SESSION['username'];
          ?>
          <select class="input-group" name="percorso">
            <?php
            $res=mysqli_query($db, "SELECT nomePercorso FROM percorso WHERE creatorePercorso = '$username' ORDER BY nomePercorso ASC");
            while ($row=mysqli_fetch_assoc($res)) { ?>
             <option><?php echo $row['nomePercorso']; ?></option>
           <?php } ?>
          </select>
          <button type="submit" name="cercaPercorso" class="btn">Cerca percorso</input>
        </div>
        <?php if (isset($_POST['cercaPercorso'])): ?>
          <div class="input-group">
            <label>Seleziona l'attrattiva</label>
            <?php
            $_SESSION['percorso'] = $_POST['percorso'];
            $percorsoDue = $_SESSION['percorso'];
            echo 'Inserisci la attrattiva nel percorso <strong>'.$percorsoDue.'</strong><br><br><br>';


            $queryAttrattiva = ("CALL infoAttrattivaCitta('$citta')");
            $query = mysqli_query($db, $queryAttrattiva);
            $count = 1;
            while ($row=mysqli_fetch_assoc($query)) {
              echo 'Attrattiva numero: <strong>'.$count.'</strong><br>';

              $_SESSION['nome'] = $row['nome'];
              $nome = $_SESSION['nome'];
              $indirizzo = $row['indirizzo'];
              $latitudine = $row['latitudine'];
              $longitudine = $row['longitudine'];
              $foto = $row['foto'];
              $citta = $row['citta'];
              $tipo = $row['tipologia'];

              echo 'Nome: <strong> '.$nome. '</strong><br>';
              echo 'Indirizzo: <strong>'.$indirizzo.'</strong><br>';
              echo 'Latitudine: <strong>'.$latitudine.'</strong><br>';
              echo 'Longitudine: <strong> '.$longitudine. '</strong><br>';
              echo 'Tipologia: <strong> '.$tipo. '</strong><br>';
              echo 'Foto: <strong> '.$foto. '</strong><br><button type="submit" name="aggiungi" class="btn">Aggiungi al Percorso</button><br><br>';
              $count++;
            }?>
          </div>
        <?php endif; ?>



        <?php if (isset($_POST['aggiungi'])): ?>

          <?php $percorsoDue = $_SESSION['percorso']; ?>
          <?php $nomeDue = $_SESSION['nome']; ?>

          <?php echo '   '.$nomeDue.'Attrattiva inserita nel percorso <strong>'.$percorsoDue.'</strong><br>';?>
        <?php endif; ?>

       <div>
         <p> <a href="index.php">Torna alla home</a> </p>
       </div>
      </form>
    </div>
  </body>
</html>
