<?php

$_SESSION = array();
session_destroy();
header("Location: view/connexionView.php");
