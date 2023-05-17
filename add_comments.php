<?php
    
    
    include_once('connect.php');


if (isset($_POST['poster']))
{
    $postData = $_POST;
    if (!empty($postData['comment']) && !empty($postData['ranking']))
    {
        session_start();
        $user = $_SESSION['user'];
        $comment = $postData['comment'];
        $ranking = $postData['ranking'];
        $id = $_GET['id'];
        var_dump($id);
        $commentDate = date("Y-m-d H:i:s");
        var_dump($commentDate);
        $insertCommentQuery = 'INSERT INTO comments (user_id, comment_text, ranking, created_at, recipe_id) 
        VALUES (:user_id, :comment, :ranking, :comment_date, :recipe_id)';
        $insertCommentStatement = $mysqlConnection->prepare($insertCommentQuery);
        $insertCommentStatement->execute([
            'user_id' => $user['user_id'],
            'comment' => $comment,
            'ranking' => $ranking,
            'comment_date' => $commentDate,
            'recipe_id' => $id,
        ]);
        header("Location: show_recipe.php?id=".$id);
        exit;
    
    }
    
}

if (isset($_POST['back']))
{
    header("Location: http://localhost/P3C2/index.php");
}
?>


<div class="container">
    <h1>Ajouter un commentaire</h1>
        <form action="add_comments.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <div class="mb-3">
                <label for="comment" class="form-label">Votre commentaire</label>
                <textarea class="form-control" placeholder="Exprimez vous" id="comment" name="comment" required></textarea>
            </div>
            <div class="mb-3">
                <label for="ranking" class="form-label">Votre note</label>
                <input type="number"  class="form-control" min="1" max="5" id="ranking" name="ranking" required style="width: 15%;">
            </div>
            <button type="submit" class="btn btn-primary" name="poster">Poster mon commentaire</button>
            <button type="submit" class="btn btn-primary" name="back">Revenir au menu</button>
            
        </form>
</div>