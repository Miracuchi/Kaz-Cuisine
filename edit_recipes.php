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

                if (!isset($_SESSION['user'])){
                    header("Location: http://localhost/P3C2/index.php");
                    exit();
                }

                $user = $_SESSION['user'];

                if ($_SERVER['REQUEST_METHOD'] === 'POST')
                {
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $recipe = $_POST['recipe'];

                    if (empty($title) || empty($recipe))
                    {
                        $errorMessage = "Veuillez remplir tous les champs";
                    } else {
                        $sqlQuery2 = 'UPDATE recipes SET title = :title, recipe = :recipe WHERE recipe_id = :id';
                        $updatedRecipe = $mysqlConnection->prepare($sqlQuery2);
                        $updatedRecipe->execute([
                            'id' => $id,
                            'title' => $title,
                            'recipe' => $recipe
                        ]);

                        header("Location: http://localhost/P3C2/index.php");
                        exit();
                    }
                } else {
                    $id = $_GET['id'];
                    $sqlQuery = 'SELECT title, recipe FROM recipes WHERE recipe_id = :id';
                    $recipeToUpdate = $mysqlConnection->prepare($sqlQuery);
                    $recipeToUpdate->execute([
                        'id' => $id]);
                    $recipe = $recipeToUpdate->fetch();
                }

                if (isset($_POST['annuler']))
                {
                    header("Location: http://localhost/P3C2/index.php");
                }
            ?>
            <h1>Modifier la recette</h1>
            <form method="POST" action="edit_recipes.php">
                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" class="form-control" name="title" id="title" value="<?php echo ($recipe['title']); ?>">
                </div>
                <div class="mb-3">
                    <label for="recipe" class="form-label">Votre recette</label>
                    <textarea class="form-control" name="recipe" id="recipe"><?php echo ($recipe['recipe']); ?></textarea>
                </div>    
                    <button type="submit" class="btn btn-primary" name="confirmer">Confirmer</button>
                    <button type="submit" class="btn btn-danger" name="annuler">Annuler</button>
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
            </form>
        </div>
    </body>
</html>