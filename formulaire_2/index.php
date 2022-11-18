<?php 
$msg="";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['envoi'])){
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';
    require 'PHPMailer/Exception.php';

    $mail= new PHPMailer();

    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';  // SMTP de Gmail
    $mail->Port = '587'; //numéro de Gmail
    $mail->SMTPSecure = 'tls';  
    $mail->Username = ''; //l'adresse email de votre site ou l'adresse email réceptrice des messages
    $mail->Password = ''; // Mot de passe des applications comme expliqué sur le formulaire_1

    $mail->setFrom($_POST['mail'], $_POST['nom']);
    $mail->addAddress('');
    $mail->addReplyTo($_POST['mail'], $_POST['nom']);

    $body= "<h3>".$_POST['nom']."</h3> <br> 
    <h3>".$_POST['mail']."</h3> <br> 
    <article style=\"font-size: 1.19em; font-weight: 400\">". $_POST['message']."</article>"; // Ce n'est pas obligatoire je l'ai fait pour structurer mon message

    $mail->isHTML();
    $mail->Subject = $_POST['sujet'];
    $mail->Body = $body;

   if(!empty($_POST['nom']) && !empty($_POST['mail']) && !empty($_POST['message'])){

        if($mail->send()){
       
         $msg= '<p style="color: green; background-color: lightgreen; padding: 0.5em; width: 100%; text-align: center"> Merci '.$_POST['nom'].' de nous avoir contacté. Vous recevrez bientôt une réponse </p>'; 
        }else {
            $msg= "<p style=\"color: red; background-color: lightcoral; padding: 0.5em; width: 100%; text-align: center\">Une erreur s'est produite. Veuillez réessayer </p>";
        }

   }else{
      $msg= "<p style=\"color: red; background-color: lightcoral; padding: 0.5em; width: 100%; text-align: center\">Veuillez remplir les champs </p>";
   }

   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   <link rel="stylesheet" href="./style.css">
</head>
<body>
    <form action="" method="post">
        <h2><i> Formulaire de contact </i></h2>
                <?= $msg ?>
        <p id="first">
            <input type="text" name="nom" id="left" placeholder="Entrez votre nom complet...">
            <input type="email" name="mail" id="right" placeholder="Entrez votre email...">
        </p>
        <input type="text" name="sujet" placeholder="Entrez l'objet de votre message...">
        <textarea name="message" id="message" cols="30" rows="10" placeholder="Ecrivez votre message..."></textarea>
        <input type="submit" name="envoi"  id="bouton" value="Envoyer">
    </form>
</body>
</html>