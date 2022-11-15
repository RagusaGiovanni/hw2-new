<?php

$conn=mysqli_connect("localhost","root","","sitoesempio") or die("Errore".mysqli_connect_error());
$username=mysqli_real_escape_string($conn,$_GET['q']);
$query="SELECT username FROM utenti WHERE username= '$username'";
$res=mysqli_query($conn,$query);
if(mysqli_num_rows($res)>0)
{
    echo "exists";
}


?>