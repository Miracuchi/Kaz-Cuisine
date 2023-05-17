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
            $postData = $_POST;

            // Ici on vérifie que l'utilisateur existe ou pas. Si ce n'est pas le cas, on le redirige vers la page de connexion.
            if (!isset($_SESSION['user'])){
                header("Location: http://localhost/P3C2/index.php");
                exit();
            };

            // Arrivé ici on a déjà vérifié l'existence du compte (que l'utilisateur soit connecté). On execute donc l'ajout de recette si le formulaire a bien été rempli.
            if (!empty($postData['title']) && !empty($postData['recipe']))
            {
                $user = $_SESSION['user'];
                $title = $postData['title'];
                $recipe = $postData['recipe'];
                $sqlQuery = 'INSERT INTO recipes(title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)';
                $result = $mysqlConnection->prepare($sqlQuery);
                $result->execute([
                    'title' => $title,
                    'recipe' => $recipe,
                    'author' => $user['full_name'],
                    'is_enabled' => true,
                ]);
            };
        ?>

        <?php if(isset($result)): ?>
        <h1>Recette bien reçu !</h1>
        
        <div class="card">
            
            <div class="card-body">
                <h5 class="card-title">Rappel de vos informations</h5>
                <p class="card-text"><b>Titre</b> : <?php echo($title); ?></p>
                <p class="card-text"><b>Recette</b> : <?php echo strip_tags($recipe); ?></p>
            </div>
        </div>
    <?php endif ?>

        <h1>Ajoutez votre recette</h1>
        <form action="add_recipes.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Titre de votre recette</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="recipe" class="form-label">Votre recipe</label>
                <textarea class="form-control" placeholder="Exprimez vous" id="recipe" name="recipe"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter ma recette</button>
        </form>
        <br />
    </div>

    <?php include_once('footer.php'); ?>
</body>
</html>