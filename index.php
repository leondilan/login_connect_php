<?php 

    if(session_status() === PHP_SESSION_NONE) session_start();
    if (isset($_SESSION['idUser'])) {
        header('Location:/pages/home.php');
        exit;
    }

    require('connexion/database.php');
    require('validation/erreur.php');

    $connect=new Database();

    if (isset($_POST['email'],$_POST['pass'])) {
        $E=new Erreur(null,$_POST['email'],$_POST['pass']);
        if ($E->Invalid()) {
            $errors=$E->getErrors();
        }else {
            $sucess=$connect->login($_POST['email'],$_POST['pass']);
        }
    }

    require('template/header.php'); 
?>

    <div class="container mt-5">
        <h1 class="text-center">CONNECTEZ-VOUS</h1>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <?php if(isset($sucess) && $sucess===false): ?>
                    <div class="alert alert-danger">Identifiant Incorrect</div>
                <?php endif; ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="text" class="form-control" id="email" placeholder="name@example.com" name="email">
                        <?php if(isset($errors['email'])): ?>
                            <p class="text-danger"><?= $errors['email'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Mot de Passe</label>
                        <input type="password" class="form-control" id="pass" name="pass">
                        <?php if(isset($errors['pass'])): ?>
                            <p class="text-danger"><?= $errors['pass'] ?></p>
                        <?php endif; ?>
                    </div>
                    <p class="text-center my-2">
                        Pas de Compte? <a href="/pages/register.php">Inscrivez Vous</a>
                    </p>
                    <button type="submit" class="btn btn-primary w-100">Connexion</button>
                </form>
            </div>
        </div>
    </div>

<?php require('template/footer.php'); ?>