<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="style.css" rel="stylesheet"/>
  <title>TP BLOG</title>
</head>

<body>
  <div align="center">
    <h1>Bienvenue sur le blog de Manon </h1> <br />
  </div>
    <h3> Les derniers articles </h3> <br /> <br />

  <?php
  // Connexion à la base de données
  try {
    $bdd = new PDO('mysql:host=localhost;dbname=TPblog;charset=utf8', 'root', 'root');
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }

  ?>

  <div class="Titre">
    <?php
  $req = $bdd->query('SELECT id, titre, contenu  FROM billets');
  while ($donnees = $req->fetch()) {
    echo $donnees['titre'];
  ?>
  </div>
  
  <div class="News">
      <?php
      echo $donnees['contenu'];
      ?>
      <a href="commentaire.php?billet=<?php echo $donnees['id']; ?>"> <br /> Commentaires</a> 
      </p>
    </div>

  <?php
  }
  $req->closeCursor();
  ?>
  <div> 
  <a href="accueil.php"> <br /> S'inscrire </a> 
  <a href="connexion.php"> <br /> Se connecter </a> 
  
  </div>
</body>

</html>