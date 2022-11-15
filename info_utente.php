<?php

$conn=mysqli_connect("localhost","root","","sitoesempio") or die("Errore".mysqli_connect_error());
$nome_cercato=mysqli_real_escape_string($conn,$_GET['utente']);

$query="SELECT nome,cognome FROM utenti WHERE username=$nome_cercato";
$res=mysqli_query($conn,$query);
$ceo=mysqli_fetch_assoc($res);
echo json_encode($ceo);

mysqli_free_result($res);
mysqli_close($conn);   

?>