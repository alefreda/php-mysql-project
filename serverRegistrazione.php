<?php
session_start();

$username = "";
$email    = "";
$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'seemycity');

if (isset($_POST['aggiungiCitta'])) {

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "Devi prima effettuare il login";
  	header('location: login.php');
  }


  $nomeCitta = $_POST['nomeCitta'];
  $regioneCitta = $_POST['regioneCitta'];
  $statoCitta = $_POST['statoCitta'];
  $fotoCitta = $_POST['fotoCitta'];

  if (empty($nomeCitta)) { array_push($errors, "Nome richiesto"); }
  if (empty($statoCitta)) { array_push($errors, "Stato richiesto"); }
  if (empty($fotoCitta)) { array_push($errors, "Foto richiesta"); }

  $queryVerificaCitta = "SELECT * FROM citta WHERE nome='$nomeCitta' LIMIT 1";
  $result = mysqli_query($db, $queryVerificaCitta);
  $citta = mysqli_fetch_assoc($result);
  if ($citta) { // if user exists
    if ($_POST['nomeCitta'] === $nomeCitta) {
      array_push($errors, "La città esiste già");
    }
  }

  if (count($errors)==0) {
    $query = "INSERT INTO citta (nome,regione,stato,foto)
    VALUES ('$nomeCitta','$regioneCitta','$statoCitta','$fotoCitta')";
    mysqli_query($db,$query);
    $_SESSION['success'] = "Città inserita con successo!";
    header('location: register.php');
  }
}

if (isset($_POST['reg_user'])) {

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password_1 = $_POST['password_1'];
  $password_2 = $_POST['password_2'];
  $residenza = $_POST['residenza'];
  $data_nascita = $_POST['data_nascita'];

  if (empty($username)) { array_push($errors, "Nome utente richiesto"); }
  if (empty($email)) { array_push($errors, "Email richiesta"); }
  if (empty($password_1)) { array_push($errors, "Password richiesta"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Le due password non combaciano");
  }
  if (empty($residenza)) { array_push($errors, "Residenza Richiesta"); }
  if (empty($data_nascita)) { array_push($errors, "Data di nascita richiesta"); }

  $queryVerificaUtente = "SELECT * FROM utente WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $queryVerificaUtente);
  $user = mysqli_fetch_assoc($result);
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Il nome utente esiste già");
    }
    if ($user['email'] === $email) {
      array_push($errors, "La e-mail esiste già");
    }
  }
  if (count($errors) == 0) {
    $password = md5($password_1);
    $tipologia = "Semplice";

    $queryInsUtente = $db -> prepare("CALL registraUtente('$username','$email','$password','$data_nascita','$residenza','$tipologia', @res)");
    $queryInsUtente -> execute();
    $queryInsUtente = $db -> prepare("SELECT @res");
    $queryInsUtente -> execute();
    $risultato = $queryInsUtente -> fetch();

    $_SESSION['success'] = "Ti sei registrato con successo";
    header('location: login.php');
  }
}

if (isset($_POST['reg_gestore'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password_1 = $_POST['password_1'];
  $password_2 = $_POST['password_2'];
  $residenza = $_POST['residenza'];
  $data_nascita = $_POST['data_nascita'];
  $attivita = $_POST['attivita'];
  $indirizzo = $_POST['indirizzo'];
  $recapito = $_POST['recapito'];
  $sitoweb = $_POST['sitoweb'];

  if (empty($username)) { array_push($errors, "Nome utente richiesto"); }
  if (empty($email)) { array_push($errors, "Email richiesta"); }
  if (empty($password_1)) { array_push($errors, "Password richiesta"); }
  if ($password_1 != $password_2) {
	array_push($errors, "Le due password non combaciano");
  }
  if (empty($residenza)) { array_push($errors, "Residenza Richiesta"); }
  if (empty($data_nascita)) { array_push($errors, "Data di nascita richiesta"); }
  if (empty($attivita)) { array_push($errors, "Nome Attività Richiesto"); }
  if (empty($indirizzo)) { array_push($errors, "Indirizzo Richiesto"); }
  if (empty($recapito)) { array_push($errors, "Recapito Richiesta"); }
  if (empty($sitoweb)) { array_push($errors, "Sito Web Richiesto"); }

  $gestore_check_query = "SELECT * FROM gestore WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $gestore_check_query);
  $gestore = mysqli_fetch_assoc($result);
  if ($gestore) {
    if ($gestore['username'] === $username) {
      array_push($errors, "Il nome utente esiste già");
    }
    if ($gestore['email'] === $email) {
      array_push($errors, "La e-mail esiste già");
    }
  }
  if (count($errors) == 0) {
    $password = md5($password_1);
    $tipologia = "Gestore";

    $queryInsGestore = $db -> prepare("CALL registraGestore('$username','$email','$password','$data_nascita','$residenza','$attivita', '$indirizzo','$recapito','$sitoweb','$tipologia', @res)");
    $queryInsGestore -> execute();
    $queryInsGestore = $db -> prepare("SELECT @res");
    $queryInsGestore -> execute();
    $risultato = $queryInsGestore -> fetch();

    $_SESSION['success'] = "Ti sei registrato con successo";
    header('location: login.php');
  }
}
?>
