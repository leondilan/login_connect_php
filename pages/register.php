<?php 

    require('../connexion/database.php');
    require('../validation/erreur.php');

    $connect=new Database();

    if (isset($_POST['name'],$_POST['email'],$_POST['pass'])) {
        $E=new Erreur($_POST['name'],$_POST['email'],$_POST['pass']);
        if ($E->Invalid()) {
            $errors=$E->getErrors();
        }else {
            $connect->create($_POST['name'],$_POST['email'],$_POST['pass']);
        }
    }

    require('../template/header.php'); 
?>

    <div class="container mt-5">
        <h1 class="text-center">INSCRIVEZ-VOUS</h1>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <form method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <?php if(isset($errors['name'])): ?>
                            <p class="text-danger"><?= $errors['name'] ?></p>
                        <?php endif; ?>
                    </div>
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
                        Déjà un Compte? <a href="/">Connectez Vous</a>
                    </p>
                    <button type="submit" class="btn btn-primary w-100">Incription</button>
                </form>
            </div>
        </div>
    </div>

<?php require('../template/footer.php'); ?>