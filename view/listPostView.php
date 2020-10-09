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
        <?=htmlspecialchars($donnees['titre']); ?>
        <em>le <?= $donnees['date_creation']; ?></em>
      </h3>

      <p>
        <?=nl2br(htmlspecialchars($donnees['contenu'])); ?>
        <br />
        <em><a href="index.php?action=billet&id=<?= $donnees['id'] ?>">Commentaires</a></em>
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
