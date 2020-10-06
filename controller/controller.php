<?php

require('model/model.php');

function listBillets()
{
    $billets = getBillets();

    require('view/listPostView.php');
}

function billet()
{
    $billet = getBillet($_GET['id']);
    $comments = getComments($_GET['id']);

    require('view/postView.php');
}