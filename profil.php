<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=TPblog;charset=utf8', 'root', 'root');

?>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
    <div align="center">
        <h2>Profil de <?php echo $_SESSION['pseudo']; ?></h2>

        <br />
        Mail = <?php echo $_SESSION['mail']; ?>
        <br />

        <a href="edition.php">Editer mon profil</a> <br /> <br />
        <a href="deconnexion.php">Se déconnecter</a> <br />
        <a href="index.php">Retour à l'accueil</a>




    </div>
</body>

</html>