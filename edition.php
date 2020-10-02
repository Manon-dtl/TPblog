<?php
session_start();
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=TPblog;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

if(isset($_SESSION['id'])) {
    $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $userexist = $requser->fetch();
    if(isset($_POST['nouveaupseudo']) AND !empty($_POST['nouveaupseudo']) AND $_POST['nouveaupseudo'] != $userexist['nouveaupseudo']) {
       $nouveaupseudo = htmlspecialchars($_POST['nouveaupseudo']);
       $insertpseudo = $bdd->prepare("UPDATE membres SET pseudo = ? WHERE id = ?");
       $insertpseudo->execute(array($nouveaupseudo, $_SESSION['id']));
       header('Location: profil.php?id='.$_SESSION['id']);
    }
    if(isset($_POST['nouveaumail']) AND !empty($_POST['nouveaumail']) AND $_POST['nouveaumail'] != $userexist['nouveaumail']) {
       $nouveaumail= htmlspecialchars($_POST['nouveaumail']);
       $insertmail = $bdd->prepare("UPDATE membres SET email = ? WHERE id = ?");
       $insertmail->execute(array($nouveaumail, $_SESSION['id']));
       header('Location: profil.php?id='.$_SESSION['id']);
    }
    if(isset($_POST['nouveaupass']) AND !empty($_POST['nouveaupass']) AND isset($_POST['nouveaupassverif']) AND !empty($_POST['nouveaupassverif'])) {
       $nouveaupass = password_hash($_POST['nouveaupass'], PASSWORD_DEFAULT);
       $nouveaupassverif =   password_hash($_POST['nouveaupassverif'], PASSWORD_DEFAULT);
       if($nouveaupass ==  $nouveaupassverif ) {
          $insertmdp = $bdd->prepare("UPDATE membres SET pass= ? WHERE id = ?");
          $insertmdp->execute(array($nouveaupass, $_SESSION['id']));
          header('Location: profil.php?id='.$_SESSION['id']);
       } else {
          $msg = "Vos deux mdp ne correspondent pas !";
       }
    }
 ?>

<html>
   <head>
      <title>TP PHP</title>
      <meta charset="utf-8">
   </head>
   <body>
      <div align="center">
         <h2>Edition de mon profil</h2>
         <div align="left">
            <form method="POST" action="" enctype="multipart/form-data">
               <label>Pseudo :</label>
               <input type="text" name="nouveaupseudo" placeholder="Pseudo" value="<?php echo $userexist['pseudo']; ?>" /><br /><br />
               <label>Mail :</label>
               <input type="text" name="nouveaumail" placeholder="Mail" value="<?php echo $userexist['mail']; ?>" /><br /><br />
               <label>Mot de passe :</label>
               <input type="password" name="nouveaupass" placeholder="Mot de passe"/><br /><br />
               <label>Confirmation - mot de passe :</label>
               <input type="password" name="nouveaupassverif" placeholder="Confirmation du mot de passe" /><br /><br />
               <input type="submit" value="Mettre à jour mon profil " />
            </form>
            <?php if(isset($msg)) { echo $msg; } ?>
         </div>
      </div>
   </body>
</html>
<?php
}
else {
    header("Location:connexion.php");
}
?>