<?php

class InscriptionManager extends Manager
{

    public function testMail($mail)
    {
        $db = $this->dbConnect();
        $reqmail = $db->prepare("SELECT * FROM membres WHERE email = ?");
        $reqmail->execute(array($mail));
        $mailexist = $reqmail->rowCount();

        return $mailexist;
    }

    public function testPseudo($pseudo)
    {
        $db = $this->dbConnect();
        $reqpseudo = $db->prepare("SELECT * FROM membres WHERE pseudo = ?");
        $reqpseudo->execute(array($pseudo));
        $pseudoexist = $reqpseudo->rowCount();

        return $pseudoexist;
    }

    public function createmember($pseudo, $pass, $mail)
    {
        $db = $this->dbConnect();
        $insertmembre = $db->prepare("INSERT INTO membres (pseudo, pass, email) VALUES ( ?, ?, ?)");
        $insertmembre->execute(array($pseudo, password_hash($pass, PASSWORD_DEFAULT), $mail));

        return $insertmembre;
    }
}
