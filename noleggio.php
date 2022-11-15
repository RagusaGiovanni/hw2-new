<?php

$conn=mysqli_connect("localhost","root","","sitoesempio") or die("Errore".mysqli_connect_error());
$marca=mysqli_real_escape_string($conn,$_GET['marca']);
$veicolo=$_GET['veicolo'];
$volume=$_GET['volume'];
$anno=$_GET['anno'];
$query="SELECT codFiscale_prop,nome_prop,cognome_prop,eta_prop FROM noleggio WHERE marca='$marca' AND veicolo= '$veicolo' AND volume='$volume' AND anno='$anno'";
$res=mysqli_query($conn,$query);
$entry=mysqli_fetch_assoc($res);
echo json_encode($entry);
mysqli_free_result($res);
mysqli_close($conn);

?>