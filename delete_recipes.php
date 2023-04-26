<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Site de Recettes - Page d'accueil</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
            rel="stylesheet"
        >
    </head>
    <body class="d-flex flex-column min-vh-100">
        <div class="container">
            <?php
                include_once('header.php');
                include_once('connect.php');

                if (!isset($_SESSION['user']))
                {
                    header("Location: http://localhost/P3C2/home.php");
                    exit();
                }

                if (isset($_POST['supprimer']) && !empty($_POST['id']))
                {
                    $user = $_SESSION['user'];
                    $id = $_POST['id'];
                    $sqlQuery = 'DELETE FROM recipes WHERE recipe_id = :id';
                    $deleted = $mysqlConnection->prepare($sqlQuery);
                    $deleted->execute([
                    'id' => $id]);
                    header("Location: http://localhost/P3C2/home.php");
                }

                if (isset($_POST['annuler']))
                {
                    header("Location: http://localhost/P3C2/home.php");
                }
            ?>

            <h1>Supprimer la recette ?</h1>
            <form action="delete_recipes.php" method="POST">
                <div class="mb-3 visually-hidden">
                    <label for="id" class="form-label">Identifiant de la recette</label>
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $_GET['id']; ?>">
                </div>
                <button type="submit" class="btn btn-danger" name="supprimer">La suppression est irréversible</button>
                <button type="submit" class="btn btn-danger" name="annuler">Annuler</button>
            </form> 
        </div>
    </body>
</html>