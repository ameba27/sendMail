# sendMail
Ce projet consiste à faire des tests sur les systèmes d'envoi de messages dans des comptes emails (gmail ou autres ...). Pour ce faire, nous allons nous basés sur des formulaires . Le premier va nous permettre d'envoyer des messages à n'importe quel compte email. Le deuxième, nous permettra d'envoyer des messages à partir d'un email comme sur les sites web, précisément les formulaires de contact. 
# formulaire_1
Dans ce dossier nous avons trois fichiers et un dosser PHPMailer. Cest trois fichiers sont : 
  # 1-index.php
  Dans celui-ci figure notre formulaire contenant le script permettant de créer une liaison avec le dossier PHPMailer-master en utilisation le fichier sendMail.php qui gère cette liaison. C'est dans notre index que nous retrouvons la partir visible du projet avec les balises et le link avec le fichier css permettant d'avoir un formulaire présentable. Ainsi vous verrez ci-dessous les codes utilisés pour créer notre formulaire.

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

En vue de faire fonctionner notre formulaire, des scripts php ont été mis à ce niveau. Pour commencer une lisaison a été créée avec le fifhier 'sendMail.php' dossier sur lequel figure notre systéme. 

    exemple : require 'sendMail.php';

Après c'est la variable $msg  pour recevoir tous les messages que notre formulaire émettra lorsqu'une requête sera faite par l'expéditeur. 
  exemple :
Si le message est envoyé , le formulaire nous indiquera que celui-ci est envoyé grâce aux codes suivants.


        $msg = "<p style=\"width: 100%; color: green; background-color: lightgreen; padding: 1em 0; margin: 0.5em; margin: auto\">Message envoyé avec succès ! </p>
        $msg= "<p style=\"width: 100%; color: red; background-color: lightcoral; padding: 1em 0; margin: 0.5em; margin: auto\">Veuillez entrer votre email</p>";


Suite à cela pour permettre le fonctionnement du systéme, des conditions sont utilisées :


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

La première condition énumérée s'explique du fait  que si nous avons un élément qui est supérieur à 0 figurant sur les champs de notre formulaire, alors les codes qui sont dans cette condition s'executent. Rappelons que la fonction count() permet de compter un nombre d'éléments. Ici elle nous permet de compter le nombre d'élément se trouvant sur $_POST. C'est-à-dire ces derniéres:  $_POST['mail'];  $_POST['sujet'];  $_POST['message'];
Dans cette condition se trouve les variables $recipient, $subject et $message qui reçoivent pour la première les adresses emails des destinaires avec $_POST['mail'], la deuxième l'objet de chaque message et la troisième les messages. 
Suite à ces variables une autre condition est créée servant d'envoyer les requêtes (messages, mail, nom) sur un compte email. Pour ce faire c'est la fonction send_mail() copiée sur le fichier sendMail.php qui est utilisées.

   exemple :

        function send_mail($recipient,$subject,$message) //pris sur sendMail.php

        if( send_mail($recipient, $subject, $message)) // sur index.php


Donc cette condition la fonction send_mail() nous permet d'envoyer des messages si les variables $recipient, $subject et $message comportent chacune des éléments supérieurs à 0.  Ainsi d'autres conditions ont été posées dans celle expliquée. Ces conditions permettant de restructurer le fonctionnement du systéme d'envoi et de notre formulaire afin d'éviter des erreurs. 

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



  # 2-sendMail.php

  Ce fichier permet à celui du précédent de fonctionner ou de faire fonctionner le systéme d'envoi de message par email . On peut dire que c'est celui de la configuration . Afin de comprendre ce fichier php il serait intéressant de le détailler .

  Pour connecter les fichiers à ceux qui se trouvent dans le dossier PHPMailer-master la fonction require() est utilisée .

  exemple:

        require 'PHPMailer-master/src/Exception.php';

        require 'PHPMailer-master/src/PHPMailer.php';

        require 'PHPMailer-master/src/SMTP.php';


  Ensuite c'est la fonction send_mail() que l'on retrouve avec les mêmes variables du précédent fichier.
  Dans cette fonction nous retrouvons aussi la variable $mail qui recoit new PHPMailer() et à qui on affecte d'autres objets et fonctions. Parmi eux nous allons évoqués les plus importants et utiles.

   # $mail->Host = ''; 
  dans ce cas de figure, c'est à nous d'entrer le SMTP du site par lequel nous voulons enregistrer le Username ou l'email expéditeur de message c'est-à-dire notre compte email . Exemple si vous utilisez gmail son Host sera:

    $mail->Host = 'smtp.gmail.com';

  ou encore Outlook:

    $mail->Host = 'smtp-mail.outlook.com';
  
   # $mail->Port = ''; 
  Ici on nous demande d'entrer le numéro de port de smtp du site que nous avons choisi. Pour ceux qui choisissent Gmail le port est : 

    $mail->Port = '587';

   # $mail->Username = ''; 
   Dans Username il est demandé de mettre votre email expédieur des messages que vous comptez envoyer. Parexmple

    $mail->Username = 'exemple@gmail.com';

   # $mail->Password = '';
   A ce niveau il est plus prudent de mettre si votre compte est protégé " une mot de passe des applications" quand vous utilisez un compte Gmail . Pour ce faire, il faut vous connecter dans votre compte précisément sur l'interface "Google compte" vous cliquez sur Sécurité  ensuite vous défilez un peu vers le bas vous verrez "Connexion à Google". Arriver à ce niveau , après Mot de Passe et Validation en deux étapes qui doit être active ou activée  il faut maintenant cliquer sur "Mots de passe des applications". Là on vous demandera d'entrer le mot de passe de votre compte. Aprés vous serez dans l'interface "Mots de passe des applications" vous cliquez sur "Sélectionner une l'application" puis sur "Autre (Nom personnalisé)"; il vous sera demandé d'entrer le nom de l'application, de ce fait, vous choisissez simplement "sendmail" ou le nom que vous voulez mais qui sera différent de ceux qu'on a déjà mis et enfin vous cliquez sur Générer. Ainsi une clé sera générée. C'est elle que vous allez copier et coller ici $mail->Password = ''; .
    

   # $mail->SetFrom("Mettez votre email ici", "Mettez votre nom ici");
   Dans cette partie vous mettez encore votre email le même que vous avez précédemment donné et votre nom comme suite.

    $mail->SetFrom("exemple@gmail.com", "Nom"); 



# 3-style.css 
Grâce à ce fichier notre formulaire reste présentable.



# PHPMailer-master 
Dans ce dossier aucune modification à apporter nous le laissons comme tel. 
#
#

# formulaire_2
Représentant notre deuxième et dernier formulaire, ce dossier a deux fichiers et un dossier nommé PHPMailer. L'objectif de ce formulaire et d'envoyer des messages à un seul destinataire comme sur les sites web avec les formulaires de contact d'où il tire son nom. Afin de comprendre le systéme mis dans ce formulaire il convient d'expliquer chaque fichier et leurs codes et aussi les dossiers.

# index.php
Pour expliquer notre page ou fichier index.php nous allons le cinder en deux parties : l'une avec les codes html et l'autre avec les scripts php. 

- La première partie : facile pour tout codeur donc ce n'est pas la peine d'expliquer. 

exemple: 

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


- la deuxième partie: elle est la plus importante mais la plupart des codes ont été déjà vus avec le formulaire_1.
Concernant cette partie, après avoir créé la variable $msg qui ne reçoit rien en dehors de notre condition mais qui a le même rôle que celui du premier formulaire, de même pour "use". Ils sont suivis par une condition :

     if(isset($_POST['envoi']))  Dans cette condition nous cherchons à savoir si $_POST['envoi'] existe . Si tel est le cas alors les codes qui sont en son sein s'executent. En son sein on retrouve la fonction require() qui transporte les données qui trouvent dans 