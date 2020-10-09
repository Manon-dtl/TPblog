<?php

class CommentManager
{
    public function getComment($commentId)
    {
        $db = $this-> dbConnect();
        $statement = $db->prepare('SELECT id, auteur, commentaire, DATE_FORMAT(date_commentaire ,\'%d/%m/%Y à %Hh%imin%ss\') AS date_creation  FROM commentaires WHERE id= ?');
        $statement->execute(array($commentId));

        $comment = $statement->fetch();
        return $comment;
    }

    public function getComments($billetId)
    {
        $db = $this-> dbConnect();
        $comments = $db->prepare('SELECT id, auteur, commentaire, DATE_FORMAT(date_commentaire ,\'%d/%m/%Y à %Hh%imin%ss\') AS date_creation  FROM commentaires WHERE id_billet= ? ORDER BY id DESC');
        $comments->execute(array($billetId));

        return $comments;
    }

    private function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=TPblog;charset=utf8', 'root', 'root');
        return $db;
    }


    public function billetComment($billetId, $auteur, $comment)
    {
        $db =  $this->dbConnect();
        $comments = $db->prepare('INSERT INTO commentaires (id_billet, auteur, commentaire, date_commentaire) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($billetId, $auteur, $comment));

        return $affectedLines;
    }
    public function changeComment($idComment, $comment)
    {
        $db =  $this->dbConnect();
        $comments = $db->prepare( 'UPDATE commentaires SET commentaire = ? WHERE id = ?');
        $affectedComment = $comments->execute(array($idComment, $comment));

        return $affectedComment;
    }

}