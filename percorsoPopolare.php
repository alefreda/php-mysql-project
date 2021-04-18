<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Statistica 1</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
    	<h2>Attrattiva più popolare</h2>
    </div>
    <div class="input-group">
      <form  action="percorsoPopolare.php" method="post">
				<div class="input-group">
      	  <label>Seleziona la città</label>
          <select class="input-group" name="citta">
            <?php
            $res=mysqli_query($db, "SELECT nome FROM citta ORDER BY nome ASC");
            while ($row=mysqli_fetch_assoc($res)) { ?>
             <option><?php echo $row['nome']; ?></option>
           <?php } ?>
          </select>
					<div class="input-group">
            <button type="submit" name="invio" class="btn">Cerca</button>
          </div>
      	</div>

				<?php
			  if (isset($_POST['invio'])){
          $citta = $_POST['citta'];
				echo "Statistiche relative ai percorsi di: <strong>".$citta."</strong><br>";

				$queryStat1 = ("CALL Stat2()");
				$query = mysqli_query($db, $queryStat1);

        $queryInfoStat1 = ("CALL infoStat2('$citta')");
        $query2 = mysqli_query($db, $queryInfoStat1);

					while($row=mysqli_fetch_assoc($query2)){
            echo '<br>Percorso:<strong> '.$row['nomePercorso'].'</strong><br>' ;
            echo 'Totale:<strong> '.$row['Tot'].'</strong><br>' ;
					}
				}
					?>





       <div>
         <p> <a href="index.php">Torna alla home</a> </p>
       </div>
      </form>
    </div>
  </body>
</html>
