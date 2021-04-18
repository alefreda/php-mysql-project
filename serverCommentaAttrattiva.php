<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
session_start();
$errors = array();
if (isset($_POST['inviaCommento'])) {
  $commento = $_POST['commento'];
  $voto = $_POST['voto'];
  $data = date("Y/m/d");
  $username = $_SESSION['username'];
  $attrattiva = $_SESSION['nomeAttivitaMonumento'];

  if (empty($commento)) { array_push($errors, "Commento richiesto"); }

  if (count($errors)==0) {
    $queryCommento = $db -> prepare("CALL commentaAttrattiva('$commento','$data','$voto','$username','$attrattiva', @res)");
    $queryCommento -> execute();
    $queryCommento = $db -> prepare("SELECT @res");
    $queryCommento -> execute();
    $risultato = $queryCommento -> fetch();

    $_SESSION['success'] = "Commento inserito con successo!";
    header('location: index.php');
  }
}
 ?>
