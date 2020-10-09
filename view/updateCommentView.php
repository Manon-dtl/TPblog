<?php 
$titre = 'Mon blog';
ob_start(); 
?>
<form action="index.php?action=changeComment&amp;id=<?= $comment['id'] ?>" method="post">
    <div>
        <label for="auteur">Auteur</label><br />
        <input type="text" id="auteur" name="auteur" value="<?= $comment['auteur']; ?>"/>
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment">
        <?= $comment['commentaire']; ?>
        </textarea>
    </div>
    <div>
        <input type="submit" />
    </div>
</form>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>