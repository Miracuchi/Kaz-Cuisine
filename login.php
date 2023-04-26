
<?php include('connect.php'); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (empty($_POST['email']) || empty($_POST['password']))
    {   $errorMessage = 'Veuillez remplir tous les champs';
    } else {
        // Récupérer les données du formulaire
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Vérifier si l'utilisateur existe dans la base de données
    $sqlQuery = 'SELECT * FROM users WHERE email = :email ';
    $loggin = $mysqlConnection->prepare($sqlQuery);
    $loggin->execute([
        'email' => $email,
    ]);
    $userProfil = $loggin->fetch(PDO::FETCH_ASSOC);
    header("Location: home.php");
    
        if ($userProfil){
        // L'email a été trouvé en BDD
            // if (password_verify($password, $userProfil['password'])){
            if ($password === $userProfil['password']){
                // Le password correspond avec l'email
                $_SESSION['user'] = $userProfil;
                    // On prend l'objet utilisateur et on ouvre la session 
            } else {
                $errorMessage = "Le mot de passe est incorrect.";
                // le passwor_verify renvoie faux, le mot de passe ne correspond pas à l'email
            }

        } else {
                // l'email n'a pas été trouvé en BDD
                $errorMessage = "L'email n'existe pas.";

        } 

    }  
}


if (isset($_SESSION['user'])){
    $user = $_SESSION['user'];
  }

?>


<?php if(!isset($user)): ?>
<form action="home.php" method="POST">
    <?php if(isset($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="email" class="from-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
        <div id="email-help" class="form-text">L'email utilisé lors de la création du compte</div>
    </div>
    <div class="mb-3">
        <label for="password" class="from-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn-primary">Log-in</button>
</form>

<?php else : ?>
    <div class="alert alert-success" role="alert">
        Bonjour <?php echo $user['full_name']; ?> et bienvenue sur le site !
    </div>

<?php endif; ?>