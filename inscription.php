<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>TP PHP</title>
</head>

<body>
    <div align="center">
        <h2>Inscription</h2>
        <br /><br />
        <form method="POST" action="">
            <table>
                <tr>
                    <td align="right">
                        <label for="pseudo">Pseudo :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if (isset($pseudo)) {echo $pseudo;} ?>" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail">Mail :</label>
                    </td>
                    <td>
                        <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if (isset($mail)) {echo $mail;} ?>" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mailverif">Confirmation du mail :</label>
                    </td>
                    <td>
                        <input type="email" placeholder="Confirmez votre mail" id="mailverif" name="mailverif" value="<?php if (isset($mailverif)) {echo $mailverif;} ?>" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="pass">Mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Votre mot de passe" id="pass" name="pass" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="passverif">Confirmation du mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Confirmez votre mdp" id="passverif" name="passverif" />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center">
                        <br />
                        <input type="submit" name="forminscription" value="Je m'inscris" />
                    </td>
                </tr>
            </table>
        </form>


    </div>


    <?php

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=TPblog;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    if (isset($_POST['forminscription'])) {

        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mail = htmlspecialchars($_POST['mail']);
        $mailverif = htmlspecialchars($_POST['mailverif']);
        $pass = htmlspecialchars($_POST['pass']);
        $passverif = htmlspecialchars($_POST['passverif']);

        if (!empty($_POST['pseudo']) and !empty($_POST['mail']) and !empty($_POST['mailverif']) and !empty($_POST['pass'])  and !empty($_POST['passverif'])) {


            $pseudolength = strlen($pseudo);
            if ($pseudolength <= 255) {
                if ($mail == $mailverif) {
                    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                        $reqmail = $bdd->prepare("SELECT * FROM membres WHERE email = ?");
                        $reqmail->execute(array($mail));
                        $mailexist = $reqmail->rowCount();
                        if ($mailexist == 0) {

                            if ($pseudo == $pseudo) {
                                $reqpseudo = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ?");
                                $reqpseudo->execute(array($pseudo));
                                $pseudoexist = $reqpseudo->rowCount();
                                //if ($pseudoexist == 0) {

                                if ($pass == $passverif) {
                                    $insertmembre = $bdd->prepare("INSERT INTO membres (pseudo, pass, email) VALUES ( ?, ?, ?)");
                                    $insertmembre->execute(array($pseudo, password_hash($pass, PASSWORD_DEFAULT), $mail));
                                    echo "Votre compte a bien été crée <a href=\"connexion.php\">Me connecter</a>";
                                } else {
                                    echo " Vos mots de passes ne correspondent pas";
                                }
                            } else {
                                echo "Pseudo déjà utilisé";
                            }
                        } else {
                            echo "Adresse mail déjà utilisée";
                        }
                    } else {
                        echo " Votre adresse mail n'est pas valide ";
                    }
                } else {
                    echo "Vos adresses mail ne correspondent pas ";
                }
            } else {
                echo "Votre pseudo ne doit pas dépasser 255 caractères";
            }
        } else {
            echo "Tous les champs doivent être complétés";
        }
    }





    ?>

</body>

</html>