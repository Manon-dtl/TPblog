<?php $titre = htmlspecialchars($billet['titre']); ?>
<?php ob_start(); ?>
<h1>Mon super blog !</h1>

<p><a href="/index.php">Retour à l'Accueil</a></p>

<div class="News">
    <?php echo $billet['titre']; ?>
    <p>le <?php echo $billet['date_creation']; ?></p>

    <p>
        <?php
        echo nl2br(htmlspecialchars($billet['contenu']));
        ?>
    </p>
</div>

<br /> <br />
<h5>Commentaires</h5>
<?php
while ($comment = $comments->fetch()) 
{
?>
    <p><strong><?php echo htmlspecialchars($comment['auteur']); ?>
        </strong> le <?php echo $comment['date_creation']; ?></p>
    <p><?php echo nl2br(htmlspecialchars($comment['commentaire'])) ?> </p> <p> <a href='view/updateCommentView.php'> Modifier</a>
<?php
}
?>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>

<h2>Ajouter un commentaire</h2>

<form action="index.php?action=addComment&amp;id=<?= $billet['id'] ?>" method="post">
    <div>
        <label for="auteur">Auteur</label><br />
        <input type="text" id="auteur" name="auteur" />
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>


