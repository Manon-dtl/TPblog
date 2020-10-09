<?php

class BilletManager extends Manager
{


    public function getBillets()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation FROM billets ORDER BY date_creation DESC LIMIT 0, 5');

        return $req;
    }


    public function getBillet($billetId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation  FROM billets WHERE id = ?');
        $req->execute(array($billetId));
        $billet = $req->fetch();

        return $billet;
    }

    public function getBilletFromCommentId($commentId){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation  FROM billets WHERE id = ?');
        $req->execute(array($commentId));
        $billetId = $req->fetch();
    }

}
