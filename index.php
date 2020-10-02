<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TP BLOG</title>
</head>

<body>
  <div align="center">
    <h1>Bienvenue sur le blog de Manon </h1>
  </div>

  <?php
  // Connexion à la base de données
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=TPblog;charset=utf8', 'root', 'root');
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }

  $req = $bdd->query('SELECT id, titre, contenu  FROM billets');
  while ($donnees = $req->fetch()) {
    echo $donnees['titre'];
  ?>
    <div class="News">
      <?php
      echo $donnees['contenu'];
      ?>
      <a href="commentaire.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a>
      </p>
    </div>

  <?php
  }
  $req->closeCursor();
  ?>
  <a href="accueil.php"> Espace inscription</a>
</body>

</html>