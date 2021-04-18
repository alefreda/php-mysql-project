<?php
session_start();
$errors = array();
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
function GetImageExtension($imagetype)
  {

         if(empty($imagetype)) return false;
         switch($imagetype)
         {
             case 'image/bmp': return '.bmp';

             case 'image/gif': return '.gif';

             case 'image/jpeg': return '.jpg';
             case 'image/jpg':  return '.jpg';

             case 'image/png': return '.png';

             default: return false;
         }
  }
if (isset($_POST['inserisciMonumento'])) {
  $nomeUtente = $_SESSION['username'];
  $nomeMonumento = $_POST['nomeMonumento'];
  $indirizzoMonumento = $_POST['indirizzoMonumento'];
  $latitudineMonumento = $_POST['latitudineMonumento'];
  $longitudineMonumento = $_POST['longitudineMonumento'];
  // parte caricamento foto-----------------------------------------
  




  //----------------------------------------------------------------
  $descrizioneMonumento = $_POST['descrizioneMonumento'];
  $statoMonumento = $_POST['statoMonumento'];
  $citta = $_SESSION['citta'];
  $tipologia = 'Monumento';

  if (empty($nomeMonumento)) { array_push($errors, "Nome richiesto"); }
  if (empty($indirizzoMonumento)) { array_push($errors, "Indirizzo richiesto"); }
  if (empty($latitudineMonumento)) { array_push($errors, "Latitudine richiesta"); }
  if (empty($longitudineMonumento)) { array_push($errors, "Longitudine richiesta"); }
  if (empty($descrizioneMonumento)) { array_push($errors, "Descrizione richiesta"); }

  $queryVerificaMonumento = "SELECT * FROM attrattiva WHERE nome='$nomeMonumento'";
   $result = mysqli_query($db, $queryVerificaMonumento);
   $mon = mysqli_fetch_assoc($result);
   if ($mon) {
     if (($mon['nome'] === $nomeMonumento) && ($mon['citta'] === $citta)) {
       array_push($errors, "Questo monumento esiste già in questa città");
     }
   }

  if (count($errors)==0) {



            //img
            $filename         = pathinfo($_FILES['fotoMonumento']['name']);
            //.png
            $imgtype          = $_FILES["fotoMonumento"]["type"];

            
           
            $dire_foto = $_SERVER["DOCUMENT_ROOT"] . "/SeeMyCity DEfinitivo/foto/".$nomeMonumento."/".$nomeMonumento."_".$filename['filename'].GetImageExtension($imgtype);
            
            
            if (!is_dir($_SERVER["DOCUMENT_ROOT"] . "/SeeMyCity DEfinitivo/foto/".$nomeMonumento)) {
                
                mkdir($_SERVER["DOCUMENT_ROOT"] . "/SeeMyCity DEfinitivo/foto/".$nomeMonumento, 0777, true);
                
               
                if(move_uploaded_file($_FILES['fotoMonumento']['tmp_name'], $dire_foto))
                {
                    

                    echo "caricamento completato";
                }
                
                
            }
            else
            {
                $files = glob($_SERVER["DOCUMENT_ROOT"] . "/SeeMyCity DEfinitivo/foto/".$nomeMonumento.'/*'); // get all file names
                foreach($files as $file){ // iterate files
                  if(is_file($file))
                    unlink($file); // delete file
                }
                
                 if(move_uploaded_file($_FILES['fotoMonumento']['tmp_name'], $dire_foto))
                {
                    
                    
                  echo "Aggiornamento completato con successo";
                
                }
            }
            //salva il path della immagine
            $fotoMonumento = "http://localhost/SeeMyCity%20DEfinitivo/foto/".$nomeMonumento."/".$nomeMonumento."_".$filename['filename'].GetImageExtension($imgtype);;

    $queryInserisciAttrattiva = $db -> prepare("CALL inserimentoMonumento('$nomeMonumento','$indirizzoMonumento','$latitudineMonumento','$longitudineMonumento','$fotoMonumento','$citta','$tipologia','$nomeUtente','$descrizioneMonumento','$statoMonumento', @res)");
    $queryInserisciAttrattiva -> execute();
    $queryInserisciAttrattiva = $db -> prepare("SELECT @res");
    $queryInserisciAttrattiva -> execute();
    $risultato = $queryInserisciAttrattiva -> fetch();

    $_SESSION['success'] = "Monumento inserito con successo!";
    header('location: index.php');
  }
}

if (isset($_POST['inserisciAttivita'])) {
  $nomeUtente = $_SESSION['username'];
  $nomeAttivita = $_POST['nomeAttivita'];
  $indirizzoAttivita = $_POST['indirizzoAttivita'];
  $latitudineAttivita = $_POST['latitudineAttivita'];
  $longitudineAttivita = $_POST['longitudineAttivita'];
  $fotoAttivita = $_POST['fotoAttivita'];
  $prezzoAttivita = $_POST['prezzoAttivita'];
  $orarioAperturaAttivita = $_POST['orarioAperturaAttivita'];
  $orarioChiusuraAttivita = $_POST['orarioChiusuraAttivita'];
  $chiusuraAttivita = $_POST['chiusuraAttivita'];
  $citta = $_SESSION['citta'];
  $tipo = 'Attivita';

  if (empty($nomeAttivita)) { array_push($errors, "Nome richiesto"); }
  if (empty($indirizzoAttivita)) { array_push($errors, "Indirizzo richiesto"); }
  if (empty($latitudineAttivita)) { array_push($errors, "Latitudine richiesta"); }
  if (empty($longitudineAttivita)) { array_push($errors, "Longitudine richiesta"); }
  if (empty($fotoAttivita)) { array_push($errors, "Foto richiesta"); }
  if (empty($prezzoAttivita)) { array_push($errors, "Prezzo richiesto"); }
  if (empty($orarioAperturaAttivita)) { array_push($errors, "Orario richiesto"); }
  if (empty($orarioChiusuraAttivita)) { array_push($errors, "Orario Chiusura richiesto"); }
  if (empty($chiusuraAttivita)) { array_push($errors, "Giorno richiesto"); }

  if (count($errors)==0) {
    $queryInserisciAttivita = $db -> prepare("CALL inserimentoAttivita('$nomeAttivita','$indirizzoAttivita','$latitudineAttivita','$longitudineAttivita','$fotoAttivita','$citta','$tipo','$nomeUtente','$prezzoAttivita','$orarioAperturaAttivita','$orarioChiusuraAttivita','$chiusuraAttivita', @res)");
    $queryInserisciAttivita -> execute();
    $queryInserisciAttivita = $db -> prepare("SELECT @res");
    $queryInserisciAttivita -> execute();
    $risultato = $queryInserisciAttivita -> fetch();

    $_SESSION['success'] = "Attivita Ricreativa inserita con successo!";
    header('location: index.php');
  }
}
