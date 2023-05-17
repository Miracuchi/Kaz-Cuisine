<?php

    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_NAME'];
    $username = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

    try
    {
        global $mysqlConnection;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $mysqlConnection = new PDO($dsn, $username, $password, $options);
    }

    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

?>