<div class="d-block top m-0 p-0 col-4 bg-white m-auto font-weight-bold rounded shadow-sm" style="z-index:1;">
    <h2 class=" m-0 col-12 text-white w-100 utile1" style="font-size: 20px;">
        <p class="p-4 utile1">Login Form</p>
    </h2>
    <div class="m-4 pb-1">
        <?php
        if (isset($incorrect_login)) {
        ?>
            <small id="helpId" class="text-danger"><?= $incorrect_login ?></small>
        <?php
        }
        ?>
        <form method="post" action="<?=WEBROOT?>security/seConnecter">
            <div class="form-group">
                <input type="text" class="form-control" name="login" id="login" autocomplete="on" placeholder="Login" style="height: 50px;">
                <?php
                if (isset($erreurs['login'])) {
                ?>
                    <small id="helpId" class="text-danger"><?= $erreurs['login'] ?></small>
                <?php
                }
                ?>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" autocomplete="on" placeholder="Password" style="height: 50px;">
                <?php
                if (isset($erreurs['password'])) {
                ?>
                    <small id="helpId" class="text-danger"><?= $erreurs['password'] ?></small>
                <?php
                }
                ?> </div>
            <div class="mb-5">
                <button type="submit" name="btn_connexion" id="connexion" class="mr-5 btn utile1 text-white" style="height: 40px; width:120px;">Connexion</button>
                <a href="<?=WEBROOT?>security/register" class="text-black-50">S'inscrire pour jouer?</a>
            </div>
        </form>
    </div>
</div>