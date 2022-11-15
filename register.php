<?php

session_start();
if(isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email']) && isset($_POST['username']) && 
   isset($_POST['password']) && isset($_POST['confermaPassword']))
{
    $conn=mysqli_connect("localhost","root","","sitoesempio") or die("Errore".mysqli_connect_error());
    $error=array();

    $username=mysqli_real_escape_string($conn,$_POST['username']);
    
    if(strlen($_POST['password']) < 8)
        {
            $error[]= "Caratteri password non sufficienti. Inserire 8 caratteri!";
        }

    if(strcmp($_POST['password'],$_POST['confermaPassword']) != 0)
        {
            $error[]= "Le due password non coincidono";
        }

    
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $query="SELECT email FROM utenti WHERE email= '$email'";
    $res=mysqli_query($conn,$query) or die("Errore".mysqli_connect_error());

    if(mysqli_num_rows($res)>0)
        {
            $error[]= "E-mail esistente nel nostro sito";
        }

    if(count($error) == 0)
        {
            
            $nome=mysqli_real_escape_string($conn,$_POST['nome']);
            $cognome=mysqli_real_escape_string($conn,$_POST['cognome']);
            $password=mysqli_real_escape_string($conn,$_POST['password']);

            $password=password_hash($password,PASSWORD_BCRYPT);

            $query="INSERT INTO utenti(username,password,nome,cognome,email)
            VALUES ('$username','$password','$nome','$cognome','$email')";
            $res=mysqli_query($conn,$query);
            echo "$res";

//Essendo la $query un INSERT la funzione mysqli_query ritorna un valore boolean
            if($res)
                {
                    $_SESSION['LeCar_User']=$_POST['username'];
                    header("Location:home.php");
                    mysqli_close($conn);
                }

        }

}

?>


<html>
    <link  href="stile.css" rel="stylesheet">
    <script src="validation.js" defer="true"></script>
    <body>

<div id="register">
    <div id="titoloregister">
        <label>Register</label>
    </div>

    <form  action="" class="formregister" method="post">
        <div class="control">
            <label>Nome:</label>
            <input type="text" name="nome" class="testo" id="nome" placeholder="Nome" />
			<small class="hidden"></small>
        </div>
        <div class="control">
            <label>Cognome:</label>
            <input type="text" name="cognome" class="testo" id="cognome" placeholder="Cognome" />
			<small class="hidden"></small>
        </div>
        <div class="control">
            <label>E-mail:</label>
            <input type="text" name="email" class="testo" id="email" placeholder="E-mail" />
			<small class="hidden"></small>
        </div>
        <div class="control">
            <label>Usename:</label>
            <input type="text" name="username" class="testo" id="username" placeholder="Username" />
			<small class="hidden"></small>
        </div>
        <div class="control">
            <label>Password:</label>
            <input type="password" name="password" class="testo" id="password" placeholder="Password" />
			<small class="hidden"></small>
        </div>
        <div class="control">
            <label>Conferma Password:</label>
            <input type="password" name="confermaPassword" class="testo" id="confermaPassword" placeholder="Password" />
			<small class="hidden"></small>
        </div>

        <input type="submit" class="button" value="register" />
    </form>
</div>
</body>
</html>