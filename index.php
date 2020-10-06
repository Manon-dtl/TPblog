<?php
require('controller/controller.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listBillets') {
        listBillets();
    }
    elseif ($_GET['action'] == 'billet') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            billet();
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
}
else {
    listBillets();
}