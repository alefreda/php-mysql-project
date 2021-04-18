<?php
session_start();
$errors = array();
$db = mysqli_connect('localhost', 'root', '', 'seemycity');

if (isset($_POST['inviaMessaggio'])) {
  $mittente = $_SESSION['username'];
  $destinatario = $_POST['utenteDestinatario'];
  $titolo = $_POST['titoloMessaggio'];
  $tipologia = $_POST['tipologia'];
  $messaggio = $_POST['messaggio'];
  $data = date("Y/m/d");

  if (empty($destinatario)) { array_push($errors, "Destinatario richiesto"); }
  if (empty($titolo)) { array_push($errors, "Titolo richiesto"); }
  if (empty($messaggio)) { array_push($errors, "Messaggio richiesto"); }

  if (count($errors)==0) {
  /*  $queryInvioMessaggio = ("");
    mysqli_query($db, $queryInvioMessaggio);*/

    $queryInvioMessaggio = $db -> prepare("CALL invioMessaggio('$titolo','$data','$messaggio','$tipologia','$mittente','$destinatario', @res)");
    $queryInvioMessaggio -> execute();
    $queryInvioMessaggio = $db -> prepare("SELECT @res");
    $queryInvioMessaggio -> execute();
    $risultato = $queryInvioMessaggio -> fetch();

    $_SESSION['success'] = "Messaggio inviato con successo";
    header('location: index.php');
  }

}
?>
