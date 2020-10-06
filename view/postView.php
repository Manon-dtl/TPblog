<?php $titre = htmlspecialchars($billet['titre']); ?>
<?php ob_start(); ?>
<h1>Mon super blog !</h1>

<p><a href="index.php">Retour à l'Accueil</a></p>

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
    <p><?php echo nl2br(htmlspecialchars($comment['commentaire'])); ?></p>
<?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>