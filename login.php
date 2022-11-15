<?php

session_start();
if(isset($_SESSION["LeCar_User"]))
{
    header("Location:home.php");
    exit;
}


if(isset($_POST['username']) && isset($_POST['password']))
{
    
    $conn=mysqli_connect("localhost","root","","sitoesempio") or die("Errore".mysqli_connect_error());
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);

    $query="SELECT id,username,password FROM utenti WHERE username='$username'";
    
    $res=mysqli_query($conn,$query) or die("Errore".mysqli_connect_error());
    if(mysqli_num_rows($res)>0)
    {
        $_SESSION['LeCar_User']=$username;
        header("Location:home.php");
        mysqli_close($conn);
        exit;
    }else
    {
        $error=true;
    }
}

?>

<html>
    <link  href="stile.css" rel="stylesheet">
    <body>

        
<div id="login">
    <div id="titolologin">
        <label>Login</label>
    </div>
    <div class="mostraErrore">
        <?php
            if(isset($error))
            {
                echo "<p class='error'> Username e/o password non valide <p> ";
            }

         ?>
     </div>
    <form action="login.php" class="formlogin" method="post">
        <div class="control">
            <label>Usename:</label>
            <input type="text" name="username" class="testo" placeholder="Username" /><br>
        </div>
        <div class="control">
            <label>Password:</label>
            <input type="password" name="password" class="testo" placeholder="Password" /><br>
        </div>
        <a href="register.php"><input type="button" class="button" id="register-button" name="Register" value="Register" /></a>
        <input type="submit" class="button" name="submit" value="Login" />
    </form>
</div>
</body>
</html>