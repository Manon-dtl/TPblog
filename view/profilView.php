
    <div align="center">
        <h2>Profil de <?php echo $_SESSION['pseudo']; ?></h2>
        <br />
        Mail = <?php echo $_SESSION['mail']; ?>
        <br />
        <a href="edition.php">Editer mon profil</a> <br /> <br />
        <a href="deconnexion.php">Se déconnecter</a> <br />
        <a href="index.php">Retour à l'accueil</a>
    </div>
    <?php require('view/template.php'); ?>
