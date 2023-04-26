<?php
    include_once('connect.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $pseudo = $_POST['pseudo'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        if (empty($pseudo) || empty($age) || empty($email) || empty($password)){
            $errorMessage = "Veuillez remplir tous les champs";
        } else{
            $sqlQuery3 = 'INSERT INTO users(full_name, age, email, password) VALUES (:pseudo, :age, :email, :password)';
            $updatedRecipe = $mysqlConnection->prepare($sqlQuery3);
            $updatedRecipe->execute([
                'age' => $age,
                'pseudo' => $pseudo,
                'email' => $email,
                'password' => $password,
            ]);
    
            header("Location: http://localhost/P3C2/home.php");
            exit();
        }
    } 

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
    <?php include_once('header.php'); ?>
    
<form action="register.php" method="POST">
    <?php if(isset($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="pseudo" class="form-label">Pseudo</label>
        <input type="text" class="form-control" id="pseudo" name="pseudo" aria-describedby="pseudo-help" placeholder="SexyChabine971">
        <div id="pseudo-help" class="form-text">Votre pseudo sera utiliser comme identifiant unique</div>
    </div>
    <div class="mb-3">
        <label for="age" class="form-label">Âge</label>
        <input type="number" class="form-control" id="age" name="age" aria-describedby="age-help">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
        <div id="email-help" class="form-text">Votre email sera utiliser comme identifiant unique</div>
    </div>
    <div class="mb-3">
        <label for="password" class="from-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="S'inscrire" class="btn-primary">Sign-in</button>
</form>


   
    </body>
</html>
