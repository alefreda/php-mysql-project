<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
$errors = array();

if (isset($_POST['inserisciEvento'])) {

  $username = $_SESSION['username'];
  $nomeAttivita = $_SESSION['nomeAttivita'];
  $cittaEvento = $_SESSION['citta'];
  $titoloEvento = $_POST['titoloEvento'];
  $descrizioneEvento = $_POST['descrizioneEvento'];
  $dataEvento = $_POST['dataEvento'];
  $orarioEvento = $_POST['orarioEvento'];
  $numeroPartecipanti = $_POST['numeroPartecipanti'];
  $stato = $_POST['stato'];

  if (empty($titoloEvento)) { array_push($errors, "Nome richiesto"); }
  if (empty($descrizioneEvento)) { array_push($errors, "Descrizione richiesta"); }
  if (empty($dataEvento)) { array_push($errors, "Data richiesta"); }
  if (empty($orarioEvento)) { array_push($errors, "Orario richiesto"); }
  if (empty($numeroPartecipanti)) { array_push($errors, "Numero max di partecipanti richiesto"); }

  $queryVerificaEvento = "SELECT * FROM evento WHERE titolo = '$titoloEvento'";
   $result = mysqli_query($db, $queryVerificaEvento);
   $event = mysqli_fetch_assoc($result);
   if ($event) { // if event exists
     if ($event['titolo'] === $titoloEvento) {
       array_push($errors, "Hai già inserito questo evento");
     }
   }

  if (count($errors)==0) {
    $queryInserisciEvento = $db -> prepare("CALL inserimentoEvento('$username','$nomeAttivita','$titoloEvento','$descrizioneEvento','$dataEvento','$orarioEvento','$numeroPartecipanti','$stato','$cittaEvento', @res)");
    $queryInserisciEvento -> execute();
    $queryInserisciEvento = $db -> prepare("SELECT @res");
    $queryInserisciEvento -> execute();
    $risultato = $queryInserisciEvento -> fetch();

    $_SESSION['success'] = "Evento inserito con successo!";
    header('location: index.php');
  }
}
