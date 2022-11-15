<?php
session_start();
if(!isset($_SESSION["LeCar_User"]))
{
    header("Location:login.php");
    exit;

}

$conn=mysqli_connect("localhost","root","","sitoesempio") or die("Errore".mysqli_connect_error());
$utenza=$_SESSION["LeCar_User"];
$error=array();
/*
        //info del file
        if(!empty($_FILES["image"]["name"]))
        { 
            
            $fileName = basename($_FILES["image"]["name"]); 
            $fileType = pathinfo($fileName,PATHINFO_EXTENSION); 
             
            
            $allowTypes = array('jpg','png','jpeg','gif'); 
            if(in_array($fileType, $allowTypes))
            { 
                $image = $_FILES['image']['tmp_name']; 
                $imgContent =file_get_contents($image);
            }

        }
        else
        {
            $error[]="immagine profilo non caricata";
        }*/

        if (count($error) == 0) { 
            if (isset($_FILES['image'])) {
                $file = $_FILES['image'];
                $type = exif_imagetype($file['tmp_name']);
                $allowedExt = array(IMAGETYPE_PNG => 'png', IMAGETYPE_JPEG => 'jpg', IMAGETYPE_GIF => 'gif');
                if (isset($allowedExt[$type])) {
                    if ($file['error'] === 0) {
                        if ($file['size'] < 7000000) {
                            $fileNameNew = uniqid('', true).".".$allowedExt[$type];
                            $fileDestination = file_get_contents($fileNameNew);
                            $query_fotoVeicolo= "INSERT INTO foto_veicolo(username, veicolo) VALUES('$utenza','$fileDestination')";

                            $res_fotoVeicolo = mysqli_query($conn, $query_fotoVeicolo);
                            print_r($res_fotoVeicolo);
                            
                        } else {
                            $error[] = "L'immagine non deve avere dimensioni maggiori di 7MB";
                        }
                    } else {
                        $error[] = "Errore nel carimento del file";
                    }
                } else {
                    $error[] = "I formati consentiti sono .png, .jpeg, .jpg e .gif";
                }
            }
        }

/*
//se tutto funziona allora inserisco i dati nel db
        if(count($error) == 0)
        {   
             $query_fotoVeicolo= "INSERT INTO foto_veicolo(username, veicolo) VALUES('$utenza','$fileDestination')";

             $res_fotoVeicolo = mysqli_query($conn, $query_fotoVeicolo);
             print_r($res_fotoVeicolo);

             if($res_fotoVeicolo)
             {
                mysqli_close($conn);
                
             } 
         }
*/
        
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>LeCar_homepage</title>
     
        <link rel="stylesheet" href="homepage.css">
        <link rel="stylesheet" href="bacheca.css">
        
        
        <script src="homepage.js" defer="true"></script>
        <script src="info_utenti.js" defer="true"></script>

    </head>

    <body>
        
            <header>
                <nav>
                        <a href="homepage.php">Home</a>
                        <h1>LeCar</h1>
                        <a href="logout.php">logout</a>
        
                </nav>
                    
            </header>   
        <article>
            <section class="flex_container">

                <div class="flex_left"> <!--Questo div contiene le info sull'utente che prenderò dalla sessione-->
                
                    <div class="bottom">
                            <p>Cerca altri utenti!</p>
                            <form  name="ricerca_utenti_form" method="get">

                                <input type="text" name="nome_utente" placeholder="Cerca username utenti">
                                <input type="submit" name="cerca_utente" value="Cerca" id="tasto">
                            </form>  
                        </div>

                    <div class = "sub-bottom">

                    </div>

            
                </div>
            

                
                <div class="flex_center">

                    <div class="creazione">
                        <form action="" name="creazione_form" method="post" enctype="multipart/form-data">
                            <textarea name="text_area" id="" cols="30" rows="10" placeholder="Breve descrizione del suo veicolo...."></textarea>
                        
                            <div>
                                <label>Foto Veicolo <input type="file" name="image"></label>
                                <input type="submit" name="create" value="Creapost" class="right">
                                <div class="mostraErrore">
                                    
                                 </div>
                            </div>
                            
                        </form>
                        
                    </div>

                    <div class="bacheca">



                    </div>
             
                
           
                </div>
            


            </section>


        </article>
    </body>

</html>