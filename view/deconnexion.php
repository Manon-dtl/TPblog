<?php

$_SESSION = array();
session_destroy();
header("Location: connexionView.php");
