<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'seemycity');

$errors=array();


if (isset($_POST['creaPercorso'])) {
  $nomePercorso = $_POST['nomePercorso'];
  $categoria = $_POST['categoria'];
  $durataPercorso = $_POST['durataPercorso'];
  $citta = $_SESSION['citta'];
  $username = $_SESSION['username'];

  if (empty($nomePercorso)) { array_push($errors, "Nome percorso richiesto"); }
  if (empty($durataPercorso)) { array_push($errors, "Durata percorso richiesta"); }

 $queryVerificaPercorso = "SELECT * FROM percorso WHERE nomePercorso='$nomePercorso'";
  $result = mysqli_query($db, $queryVerificaPercorso);
  $perc = mysqli_fetch_assoc($result);
  if ($perc) { // if user exists
    if ($perc['nomePercorso'] === $nomePercorso) {
      array_push($errors, "Questo percorso esiste già");
    }
  }


  if (count($errors)==0) {
    $queryCreaPercorso = $db -> prepare("CALL creaPercorso('$nomePercorso','$categoria','$durataPercorso','$citta','$username', @res)");
    $queryCreaPercorso -> execute();
    $queryCreaPercorso = $db -> prepare("SELECT @res");
    $queryCreaPercorso -> execute();
    $risultato = $queryCreaPercorso -> fetch();

    $_SESSION['success'] = "Percorso inserito con successo!";
    header('location: index.php');
  }
}
 ?>
