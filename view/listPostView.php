<?php 
$titre = 'Mon blog';
ob_start(); 
?>
  <div align="center">
    <h1>Bienvenue sur le blog de Manon </h1> <br />
  </div>
  <h3> Les derniers articles </h3> <br /> <br />


  <?php
  while ($donnees = $billets->fetch()) {
  ?>
    <div class="news">
      <h3>
        <?php echo htmlspecialchars($donnees['titre']); ?>
        <em>le <?php echo $donnees['date_creation']; ?></em>
      </h3>

      <p>
        <?php echo nl2br(htmlspecialchars($donnees['contenu'])); ?>
        <br />
        <em><a href="view/postView.php?id=<?= $donnees['id'] ?>">Commentaires</a></em>
      </p>
    </div>
  <?php
  }
  $billets->closeCursor();

  ?>

  <div>
    <a href="index.php?action=inscription"> <br /> S'inscrire </a>
    <a href="index.php?action=connexion"> <br /> Se connecter </a>

  </div>

  <?php $content = ob_get_clean();
  
require('view/template.php'); 
?>
