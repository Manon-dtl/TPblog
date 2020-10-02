<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="style.css" rel="stylesheet"/>
        <title>TP BLOG</title>
    </head>
    <body>
        <p><a href="index.php">Retour à l'Accueil</a></p>
 
<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=TPblog;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM billets WHERE id = ?');
$req->execute(array($_GET['billet']));
$donnees = $req->fetch();
if(empty($donnees))
{  
    echo 'article non atteint';
}
else{ 
?>

<div class="News">
        <?php echo ($donnees['titre']); ?>
        <p>le <?php echo $donnees['date_creation']; ?></p>
    
    <p>
     <?php
    echo nl2br(htmlspecialchars($donnees['contenu']));
    ?>
    </p>
</div>

<br /> <br /> 
<h5>Commentaires</h5>

<?php
$req->closeCursor(); 
}
$req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire');
$req->execute(array($_GET['billet']));

while ($donnees = $req->fetch())
{
?>

<p><strong><?php echo htmlspecialchars($donnees['auteur']); ?>
</strong> le <?php echo $donnees['date_commentaire']; ?></p>
<p><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
<?php
} 

$req->closeCursor();
?>
</body>
</html>