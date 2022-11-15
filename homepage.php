<?php

session_start();
if(!isset($_SESSION["LeCar_User"]))
{
    header("Location:login.php");
    exit;
}

$utenza=$_SESSION["LeCar_User"];


$conn=mysqli_connect("localhost","root","","sitoesempio") or die("Errore".mysqli_connect_error());
$descrizione=mysqli_real_escape_string($conn,$_GET['descrizione']);
$query="INSERT INTO post(utente,descrizione) VALUES('$utenza','$descrizione')";
//$res=mysqli_query($conn,$query);
//mysqli_free_result($res);
mysqli_close($conn);

echo $descrizione;

        /*
        $veicolo="SELECT veicolo FROM foto_veicolo WHERE foto_veicolo.username=$utenza";
        $res=mysqli_query($conn,$veicolo);
        $entry=mysqli_fetch_assoc($res);
        $veicolo_finale = base64_encode($entry['veicolo']);
         
        mysqli_free_result($res);
        
    
        echo json_encode($veicolo_finale); */
       

?>