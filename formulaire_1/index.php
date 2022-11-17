<?php
require 'sendMail.php';

$msg= "";
if(count($_POST) > 0){
     $recipient = $_POST['mail']; // L'adresse email devant recevoir le message
    $subject= $_POST['sujet']; // L'objet de votre Message
    $message= $_POST['message']; // Le message lui-même

    if( send_mail($recipient, $subject, $message)){
        if(empty($recipient)){
            $msg= "<p style=\"width: 100%; color: red; background-color: lightcoral; padding: 1em 0; margin: 0.5em; margin: auto\">Veuillez entrer votre email</p>";
        }
        if (empty($subject)) {
            $msg= "<p style=\"width: 100%; color: red; background-color: lightcoral, padding: 1em 0; margin: 0.5em; margin: auto\">Veuillez entrer l'objet de votre message</p>";
        }   

        if(empty($message)){
            $msg= "<p style=\"width: 100%; color: red; background-color: lightcoral; padding: 1em 0; margin: 0.5em; margin: auto\">Veuillez écrire votre message </p>";
        }

        $msg = "<p style=\"width: 100%; color: green; background-color: lightgreen; padding: 1em 0; margin: 0.5em; margin: auto\">Message envoyé avec succès ! </p>";
     } else {
        $msg = "<p style=\"width: 100%; color: red; background-color: lightcoral; padding: 1em 0; margin: 0.5em; margin: auto\">Désolé votre message n'a pas été envoyé, Veuillez réessayer </p>";
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
    <center>
        <form action="" method="post">
            <h2>Formulaire d'envoi de message à un destinataire</h2>
            <?= $msg ?>
           
            <input type="email" name="mail" id="email" placeholder="Entrez l'Adresse Email du Destinataire ">
            <input type="text" name="sujet" id="sujet" placeholder="Entrez l'objet de votre message">
            <textarea name="message" id="message" cols="30" rows="10" placeholder="Ecrivez votre message"></textarea>
            <input type="submit" name="soumette" value="Envoyer" id="bouton">
        </form>
    </center>
</body>
</html>