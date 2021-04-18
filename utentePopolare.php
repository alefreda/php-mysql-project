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
      <form  action="utentePopolare.php" method="post">


				<?php

				$queryStat1 = ("CALL Stat3()");
				$query = mysqli_query($db, $queryStat1);

        $queryInfoStat1 = ("CALL infoStat3()");
        $query2 = mysqli_query($db, $queryInfoStat1);

        echo "Lista degli utenti più attivi<br>";

					while($row=mysqli_fetch_assoc($query2)){
            echo '<br>Nome:<strong> '.$row['username'].'</strong><br>' ;
            echo 'Totale (attrattive + percorsi):<strong> '.$row['Tot'].'</strong><br>' ;
					}

					?>





       <div>
         <p> <a href="index.php">Torna alla home</a> </p>
       </div>
      </form>
    </div>
  </body>
</html>
