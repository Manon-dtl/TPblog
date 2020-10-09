<?php
require_once('model/Manager.php');
require_once('model/BilletManager.php');
require_once('model/CommentManager.php');
require_once('model/ConnexionManager.php');
require_once('model/InscriptionManager.php');

function listBillets()
{
    $billetManager = new BilletManager();
    $billets = $billetManager->getBillets(); 
    require('view/listPostView.php');
}

function billet()
{
    $billetManager = new BilletManager();
    $commentManager = new CommentManager();

    $billet = $billetManager->getBillet($_GET['id']);
    $comments = $commentManager-> getComments($_GET['id']);

    require('view/postView.php');
}

function addComment($commentId, $auteur, $comment)
{
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->billetComment($commentId, $auteur, $comment);

    if ($affectedLines === false) {
       throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    
    $billetManager = new BilletManager();
    $billet = $billetManager->getBilletFromCommentId($commentId);
    header('Location: ./index.php?action=billet&id=' . $billet['id']);
}

function connexion()
{
    $connexionManager = new ConnexionManager();

    if (isset($_POST['formconnexion'])) {
        if (!empty($_POST['pseudoconnexion']) and !empty($_POST['passconnexion'])) {

            $pseudoconnexion = htmlspecialchars($_POST['pseudoconnexion']);
            $passconnexion = htmlspecialchars($_POST['passconnexion']);
            [$datauser, $userexist] =$connexionManager->testUser($pseudoconnexion);
            if ($userexist == 1) {
                $isPasswordCorrect = password_verify($_POST['passconnexion'], $datauser['pass']);
                if ($isPasswordCorrect) {
                    $_SESSION['id'] = $datauser['id'];
                    $_SESSION['pseudo'] = $datauser['pseudo'];
                    $_SESSION['mail'] = $datauser['email'];
                    header("Location: view/profilView.php?id=" . $_SESSION['id']);
                }
            } else {
                echo "Mauvais pseudo ou mot de passe";
            }
        } else {
            echo "Tous les champs doivent être complétés";
        }
    }
    require('view/connexionView.php');
}

function inscription()
{
    $inscriptionManager = new InscriptionManager();

    if (isset($_POST['forminscription'])) {

        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mail = htmlspecialchars($_POST['mail']);
        $mailverif = htmlspecialchars($_POST['mailverif']);
        $pass = htmlspecialchars($_POST['pass']);
        $passverif = htmlspecialchars($_POST['passverif']);

        if (!empty($_POST['pseudo']) and !empty($_POST['mail']) and !empty($_POST['mailverif']) and !empty($_POST['pass'])  and !empty($_POST['passverif'])) {

            $pseudolength = strlen($pseudo);
            if ($pseudolength <= 255) {
                if ($mail == $mailverif) {
                    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                        $mailexist = $inscriptionManager-> testMail($mail);
                      
                        if ($mailexist == 0) {
                            $pseudo = $inscriptionManager-> testPseudo($pseudo);
                           
                            if ($pseudo == $pseudo) {
                                $insertmembre = $inscriptionManager-> createMember($pseudo, $pass, $mail);
                               
                                if ($pass == $passverif) {
                                    
                                    echo "Votre compte a bien été crée <a href=\"view/connexionView.php\">Me connecter</a>";
                                } else {
                                    echo " Vos mots de passes ne correspondent pas";
                                }
                            } else {
                                echo "Pseudo déjà utilisé";
                            }
                        } else {
                            echo "Adresse mail déjà utilisée";
                        }
                    } else {
                        echo " Votre adresse mail n'est pas valide ";
                    }
                } else {
                    echo "Vos adresses mail ne correspondent pas ";
                }
            } else {
                echo "Votre pseudo ne doit pas dépasser 255 caractères";
            }
        } else {
            echo "Tous les champs doivent être complétés";
        }
    }

require('view/inscriptionView.php');
}

function updateComment($idComment){
    $commentManager = new CommentManager();
    $comment = $commentManager->getComment($idComment);

    require('view/updateCommentView.php');
}

function changeComment($idComment, $comment)
{
    $commentManager = new CommentManager();
    $affectedComment = $commentManager->changeComment($idComment, $comment);
    if ($affectedComment === false) {
        throw new Exception('Impossible de modifier le commentaire !');
    }
    else {
        header('Location: ./index.php?action=billet&id=' . $billet['id']);
    }

    require('view/PostView.php');
}