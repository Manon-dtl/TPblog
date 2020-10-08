<?php

class ConnexionManager
{

public function testUser($pseudoconnexion)
    {
        $db = $this->dbConnect();
        $requser = $db->prepare("SELECT * FROM membres WHERE pseudo = ? ");
        $requser->execute(array($pseudoconnexion));
        $datauser = $requser->fetch();
        $userexist = $requser->rowCount();

        return [$datauser, $userexist];
    }
    private function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=TPblog;charset=utf8', 'root', 'root');
        return $db;
    }
}