<?php 

    require __DIR__.'./vendor/autoload.php';
    Dotenv\Dotenv::createImmutable(__DIR__)->load();
        
    if (isset($_SESSION['user']))
    {
        $user = $_SESSION['user'];
    }

    include_once('connect.php');
    
    $sqlQuery = 'SELECT title, recipe, author, recipe_id FROM recipes WHERE is_enabled = TRUE';
    $recipesStatement = $mysqlConnection->prepare($sqlQuery);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();
?>


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
                include_once('login.php'); 
            ?>

            <!-- Plus facile à lire -->
            <?php if(isset($user)): ?>
                <h1>Site de Recettes !</h1>
                <?php foreach($recipes as $recipe) : ?>
                    <article>
                        <h3><a href="show_recipe.php?id=<?php echo($recipe['recipe_id']); ?>"><?php echo($recipe['title']); ?></a></h3>
                        <i>
                            <?php echo($recipe['author']); ?>
                        </i><br>
                        <?php 
                            if ($recipe['author'] === $user['full_name']):
                        ?>
                            <a href="edit_recipes.php?id=<?php echo ($recipe['recipe_id']); ?>">Editer l'article</a>
                            <a href="delete_recipes.php?id=<?php echo ($recipe['recipe_id']); ?>">Supprimer l'article</a>
                        <?php endif; ?>
                    </article>
                <?php endforeach ?>
            <?php endif; ?>
        </div>

        <?php include_once('footer.php'); ?>
    </body>
 </html>