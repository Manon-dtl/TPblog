<?php

class ConnexionManager extends Manager
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

}