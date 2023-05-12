<?php
    
    include_once('connect.php');
    
    if (!isset($_GET['id'])) 
    {
        header('Location: index.php');
        exit();
    }
    $id = $_GET['id'];
    $sqlQuery = 'SELECT title, recipe, author, recipe_id FROM recipes WHERE recipe_id = :id';
    $recipesStatement = $mysqlConnection->prepare($sqlQuery);
    $recipesStatement->execute([
        'id' => $id]);
    $recipe = $recipesStatement->fetch();

    
    $commentsQUery = 'SELECT c.comment_id, c.comment_text, c.created_at, c.ranking, u.full_name 
            FROM comments c    
            JOIN users u ON c.user_id = u.user_id 
            WHERE c.recipe_id = :id 
            ORDER BY c.created_at DESC';
    
    $commentsStatement = $mysqlConnection->prepare($commentsQUery);
    $commentsStatement->execute(['id' => $id]);
    $comments = $commentsStatement->fetchAll();
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
                <h1></h1>
                
                    <article>
                        <h3><?php echo($recipe['title']); ?></h3>
                        <div class="card mb-3">
                            <div class="card-body">
                                <p><?php echo($recipe['recipe']); ?></p>
                            </div>
                        </div>
                        <i>
                            <?php echo($recipe['author']); ?>
                        </i><br>
                        <?php 
                            if ($recipe['author'] === $user['full_name']):
                        ?>
                            <a href="edit_recipes.php?id=<?php echo ($recipe['recipe_id']); ?>">Editer l'article</a>
                            <a href="delete_recipes.php?id=<?php echo ($recipe['recipe_id']); ?>">Supprimer l'article</a>
                        <?php endif; ?>
                                <br><br><br>

                        <?php include_once('add_comments.php'); ?>
        <br><br><br>
                        <h3>Commentaires</h3>
        <?php foreach($comments as $comment): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text"><?php echo($comment['comment_text']); ?></p>
                    <p><?php echo($comment['ranking']); ?> ⭐</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">
                    Posté par <?php echo($comment['full_name']); ?>
                    le <?php echo(date('d/m/Y à H:i', strtotime($comment['created_at']))); ?>
                    </small>
                </div>
            </div>
        <?php endforeach; ?>
                    </article>
            
            <?php endif; ?>
        </div>
        <br><br><br>
        
        
        <?php include_once('footer.php'); ?>
    </body>
</html>