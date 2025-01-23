    <div class="container">
        <p> Vous devez avoir les droits d'administrateur pour accéder à cette section. </p>
    <form action="submit_login.php" method="POST">
        <?php if (isset($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['LOGIN_ERROR_MESSAGE'];
                unset($_SESSION['LOGIN_ERROR_MESSAGE']); ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="username" class="form-label">Nom de compte</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
        </div>