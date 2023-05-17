<?php session_start(); ?>
<?php
    include_once('connect.php');
    $id = $_POST['id'];
    $sqlQuery = 'DELETE FROM recipes WHERE recipe_id = :id';
    $deleted = $mysqlConnection->prepare($sqlQuery);
    $deleted->execute([
        'id' => $id
    ]);

header("Location: http://localhost/P3C2/index.php");
?>