<?php 
    if(session_status() === PHP_SESSION_NONE) session_start();

    require('../connexion/database.php');
    $connect=new Database();
    $user=$connect->getUser($_SESSION['idUser']);

    require('../template/header.php'); 
?>

    <div class="container mt-5">
        <p class="display-6">
            Bonjour Mr <strong><?= $user['nomUser'] ?></strong>
        </p>
    </div>

<?php 

    require('../template/footer.php'); 
?>