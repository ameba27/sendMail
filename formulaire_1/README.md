# sendMail
Ce projet consiste à faire des tests sur le système d'envoi d'email sur des comptes emails(gmail et autres ...) à partir d'un site web. Pour ce faire, il sera utlisé des formulaires à partir desquels nous allons basés pour envoyer nos mails.

# formulaire_1
Dans ce dossier nous avons trois fichiers en plus du README.md et un dosser PHPMailer. Cest trois fichiers sont : 
  # index.php
  Dans celui-ci figure notre formulaire contenant le script permettant de créer une liaison avec le dossier PHPMailer-master avec à la connexion avec le ficher sendMail.php. Donc dans notre index se trouve la partir visible du projet avec les balises et le link avec le css permettant ainsi d'avoir un formulaire présentable. Ainsi vous verrez ci-dessous les codes mis pour créer notre formulaire.

   exemple: 

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

En vue de faire fonctionner notre formulaire des scripts php ont été mis à ce niveau. Pour commencer une lisaison a été créée avec le fifhier 'sendMail.php' dossier sur lequel figure notre systéme. 

    exemple : require 'sendMail.php';

Après c'est la variable $msg qui a été créée pour contenir tous les messages que notre formulaire émettra lorsqu'il y aura une requête faite par l'expéditeur. 
  exemple :
Si le message est envoyé , le formulaire nous indiquera que celui-ci est envoyé grâce au code suivant.


  $msg = "<p style=\"width: 100%; color: green; background-color: lightgreen; padding: 1em 0; margin: 0.5em; margin: auto\">Message envoyé avec succès ! </p>
  $msg= "<p style=\"width: 100%; color: red; background-color: lightcoral; padding: 1em 0; margin: 0.5em; margin: auto\">Veuillez entrer votre email</p>";


Suite à cela pour permettre le fonctionnement du systéme, des conditions sont utilisées :


  if(count($_POST) > 0){
     $recipient = $_POST['mail']; // L'adresse email devant recevoir le message

    $subject= $_POST['sujet']; // L'objet de votre Message

    $message= $_POST['message']; // Le message lui-même.....


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

La première condition énumérée s'explique du fait  que si nous avons un élément qui est supérieur à 0 figurant sur les champs de notre formulaire, alors les codes qui sont dans cette condition s'executent. Rappelons que la fonction count() permet de compter un nombre d'éléments. Ici elle nous permet de compter le nombre d'élément se trouvant sur $_POST. Par exemple chacun de ces champs ci-après. $_POST['mail'];  $_POST['sujet'];  $_POST['message'];
Dans cette condition se trouve les variables $recipient, $subject et $message qui reçoivent pour la première les adresses emails avec $_POST['mail'] des destinaires , la deuxième l'objet de chaque message et la troisième les messages. 
Suite à ces variables une autre condition est créée servant d'envoyer les requêtes (messages, mail, nom) sur un compte email. Pour ce faire c'est la fonction send_mail() copiée sur le fichier sendMail.php qui est utilisées.

   exemple :

 function send_mail($recipient,$subject,$message) //pris sur sendMail.php

 if( send_mail($recipient, $subject, $message)) // sur index.php


Donc cette condition avec la fonction send_mail() nous permette d'envoyer un message, bien sûr, si les variables $recipient, $subject et $message comportent chacune des éléments supérieurs à 0.  Ainsi d'autres condition ont été posée dans celle-ci permettant de restructurer le fonctionnement afin d'éviter des erreurs. 

   exemple :
  
        if(empty($recipient)){
            $msg= "<p style=\"width: 100%; color: red; background-color: lightcoral; padding: 1em 0; margin: 0.5em; margin: auto\">Veuillez entrer votre email</p>";
        }
        if (empty($subject)) {
            $msg= "<p style=\"width: 100%; color: red; background-color: lightcoral, padding: 1em 0; margin: 0.5em; margin: auto\">Veuillez entrer l'objet de votre message</p>";
        }   

        if(empty($message)) {
            $msg= "<p style=\"width: 100%; color: red; background-color: lightcoral; padding: 1em 0; margin: 0.5em; margin: auto\">Veuillez écrire votre message </p>";
        }



  # sendMail.php

  Ce fichier permet à celui du précédent de fonctionner ou de faire fonctionner le systéme d'envoi de message par email . On peut dire que c'est celui de la configuration . Afin de comprendre ce fichier php il serait intéressant de le détailler .

  Afin de connecter les fichiers à ceux qui se trouvent dans le dossier PHPMailer-master la fonction require() est utilisée .

    exemple
  require 'PHPMailer-master/src/Exception.php';

  require 'PHPMailer-master/src/PHPMailer.php';

  require 'PHPMailer-master/src/SMTP.php';


  Après c'est la fonction send_mail() que l'on retrouve avec les mêmes variables se trouvant dans le précédent fichier.
  Dans la fonction nous retrouvons la variable $mail qui recoit new PHPMailer() et à qui on affecte d'autres objets et fonctions. Parmi eux nous allons évoqués les plus importants et utiles.

   # $mail->Host = ''; 
  dans ce cas de figure  c'est à nous de d'entrer le SMTP du site par lequel nous voulons enregistrer le Username ou l'email expéditeur de message c'est-à-dire notre boîte email . Exemple si vous utilisez gmail son Host sera:

    $mail->Host = 'smtp.gmail.com';

  ou encore Outlook:

    $mail->Host = 'smtp-mail.outlook.com';
  
   # $mail->Port = ''; 
  Ici on nous demande d'entrer le numéro de port de smtp du site que nous avons choisi. Pour ceux qui choisissent Gmail le port est : 

    $mail->Port = '587';

   # $mail->Username = ''; 
   Dans Username il est demande de mettre votre email qui va expédier les messages que vous comptez envoyer. Parexmple

    $mail->Username = 'exemple@gmail.com';

   # $mail->Password = '';
   A ce niveau il est plus prudent de mettre si votre compte est protégé " une mot de passe des applications" si vous utilisez un compte Gmail . Pour ce faire, il faut vous connecter dans votre compte précisément sur Google compte vous cliquez sur Sécurité  ensuite vous défiler un peu vers le bas vous Verrez "Connexion à Google". Arriver à ce niveau , après Mot de Passe et Validation en deux étapes qui doivent être active ou activée vous cliquez sur "Mots de passe des applications". Là on vous demandera d'entrer le mot de passe de votre compte. Aprés vous serez dans l'interface "Mots de passe des applications" vous cliquez sur "Sélectionner une l'application" ensuite vous cliquez sur "Autre (Nom personnalisé)"; il vous sera demandé de d'entrer le nom de l'application vous choisissez simplement "sendmail" ou le nomque vous voulez différents ceux qu'on a déjà mis et enfin vous cliquez sur Générer là une clé vous sera donnée. C'est elle que vous allez copier et coller ici $mail->Password = ''; .
    

   # $mail->SetFrom("Mettez votre email ici", "Mettez votre nom ici");
   Dans cette partie vous mettez encore votre email le même que vous avez précédemment donné et votre nom comme suite.

    $mail->SetFrom("exemple@gmail.com", "Nom"); 



# style.css 
Grâce à ce fichier notre formulaire reste présentable.



# PHPMailer-master 
Dans ce dossier aucune modification à apporter nous le laissons comme tel. 
