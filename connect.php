<?php
try
{
    global $mysqlConnection;
    $mysqlConnection = new PDO(
        'mysql:host=localhost;dbname=my_recipes;charset=utf8',
        'root',
        'root',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );
}

catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

?>