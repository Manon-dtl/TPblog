<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=TPblog;charset=utf8', 'root', 'root');

?>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <div align="center">
        <h2>Profil de <?php echo $_SESSION['pseudo']; ?></h2>

        <br />
        Mail = <?php echo $_SESSION['mail']; ?>
        <br />

        <a href="edition.php">Editer mon profil</a>
        <a href="deconnexion.php">Se déconnecter</a>




    </div>
</body>

</html>