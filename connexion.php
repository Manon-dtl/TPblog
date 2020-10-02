<?php
session_start();
?>
<html>

<head>
    <title>TP BLOG</title>
    <meta charset="utf-8">
</head>

<body>
    <div align="center">
        <h2>Connexion</h2>
        <br /><br />
        <form method="POST" action="">
            <input type="pseudo" name="pseudoconnexion" placeholder="Pseudo" />
            <input type="password" name="passconnexion" placeholder="Mot de passe" />
            <br /><br />
            <input type="submit" name="formconnexion" value="Se connecter" />
        </form>

    </div>



    <?php

    try {
        $bdd = new PDO('mysql:host=localhost;dbname=TPblog;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    if (isset($_POST['formconnexion'])) {
        if (!empty($_POST['pseudoconnexion']) and !empty($_POST['passconnexion'])) {

            $pseudoconnexion = htmlspecialchars($_POST['pseudoconnexion']);
            $passconnexion = htmlspecialchars($_POST['passconnexion']);
            $requser = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ? ");
            $requser->execute(array($pseudoconnexion));
            $datauser = $requser->fetch();
            $userexist = $requser->rowCount();
            if ($userexist == 1) {
                $isPasswordCorrect = password_verify($_POST['passconnexion'], $datauser['pass']);
                if ($isPasswordCorrect) {
                    $_SESSION['id'] = $datauser['id'];
                    $_SESSION['pseudo'] = $datauser['pseudo'];
                    $_SESSION['mail'] = $datauser['email'];
                    header("Location: profil.php?id=" . $_SESSION['id']);
                }
            } else {
                echo "Mauvais pseudo ou mot de passe";
            }
        } else {
            echo "Tous les champs doivent être complétés";
        }
    }


    ?>
</body>

</html>