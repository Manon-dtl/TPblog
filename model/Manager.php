<?php

class Manager
{
    protected function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=TPblog;charset=utf8', 'root', 'root');
        return $db;
    }
}
