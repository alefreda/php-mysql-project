<?php
/*session_start();*/
$errors = array();
$db = mysqli_connect('localhost', 'root', '', 'seemycity');

if (isset($_POST['login_user'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $tipologia = "";
  $residenza = "";


  if (empty($username)) {array_push($errors, "Nome utente richiesto"); }
  if (empty($password)) {array_push($errors, "Password richiesta"); }

  if (count($errors) == 0) {
    $password = md5($password);
    
    $query = "SELECT * FROM utente WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "Login Effettutato con successo";
      header('location: index.php');
    }else {
      array_push($errors, "Combinazione username/password errata");
    }
  }
}
 ?>
