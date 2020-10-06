<?php
function getBillets()
{
	$db = dbConnect();
	$req = $db->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM billets ORDER BY date_creation DESC LIMIT 0, 5');

	return $req;
}


function getBillet($billetId)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation  FROM billets WHERE id = ?');
    $req->execute(array($billetId));
    $billet = $req->fetch();

    return $billet;
}

function getComments($billetId)
{
	$db = dbConnect();
    $comments = $db->prepare('SELECT id, auteur, commentaire, DATE_FORMAT(date_commentaire ,\'%d/%m/%Y à %Hh%imin%ss\') AS date_creation  FROM commentaires WHERE id_billet= ? ORDER BY id DESC');
    $comments->execute(array($billetId));

    return $comments;
}

function dbConnect()
{
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=TPblog;charset=utf8', 'root', 'root');
        return $db;
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
}

$title = 'Mon blog';

