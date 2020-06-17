<div class="container p-0 w-100 col-8 m-auto rounded shadow bg-white d-flex justify-content-center align-items-stretch" style="height: 600px;">

    <div class="bg-white col-8 pb-2">
        <h3 class="w-100 m-0">S'inscrire</h3>
        <p class="w-100 m-0">Pour tester votre niveau de culture génerale</p>

        <form id="form-inscription" method="post" action="<?=WEBROOT?>security/createUser" enctype="multipart/form-data" class="col-10 p-0">
        <?php
        if(isset($err_password)){
        ?>    
        <small id="error_password_match" class="text-danger" id="error_prenom"><?= $err_password ?></small>    
        <?php
        }
        ?>

        <?php
        if(isset($login_exists)){
        ?>    
        <small id="error_password_match" class="text-danger" id="error_prenom"><?= $login_exists ?></small>    
        <?php
        }
        ?>
        <div class="form-group m-0">
                <label for="prenom" class="m-0">Prénom</label>
                <input type="text" name="prenom" error="error_prenom" class="form-control " id="prenom" placeholder="Entrez votre prénom">
                <small id="error_prenom" class="text-danger" id="error_prenom"><?php if(isset($erreurs['prenom'])){ echo $erreurs['prenom']; } ?></small>
            </div>
            <div class="form-group m-0">
                <label for="nom" class="m-0">Nom</label>
                <input type="text" name="nom" error="error_nom" class="form-control" id="nom" placeholder="Entrez votre nom">
                <small id="error_nom" class="text-danger"><?php if(isset($erreurs['nom'])){ echo $erreurs['nom']; } ?></small>
            </div>
            <div class="form-group m-0">
                <label for="login" class="m-0">Login</label>
                <input type="text" name="login" error="error_login" class="form-control " id="login" placeholder="Entrez votre pseudo">
                <small id="error_login" class="text-danger"><?php if(isset($erreurs['login'])){ echo $erreurs['login']; } ?></small>
            </div>
            <div class="form-group m-0">
                <label for="password" class="m-0">Password</label>
                <input type="password" name="password" error="error_password" autocomplete="on" class="form-control" id="password" placeholder="Entrez votre password">
                <small id="error_password" class="text-danger"><?php if(isset($erreurs['password'])){ echo $erreurs['password']; } ?></small>
            </div>
            <div class="form-group">
                <label for="pwdConfirme" class="m-0">Confirmer Password</label>
                <input type="password" name="pwdConfirme" error="error_confirm" autocomplete="on" class="form-control" id="pwdConfirme" placeholder="Confirmez votre password">
                <small id="error_confirm" class="text-danger"><?php if(isset($erreurs['pwdConfirme'])){ echo $erreurs['pwdConfirme']; } ?></small>
            </div>
            <div class="w-100 d-block">
                <label for="avatar" class="d-inline text-dark float-left">Avatar</label>
                <input type="file" name="imgUser"  error="error_avatar" id="imgUser" class="d-inline d-none btn utile1 text-white font-weight-bold shadow-sm border-utile1 float-right" role="button" style="display: none;">
                <small id="error_avatar" class="text-danger"></small>
            </div>

            <div class="mt-5 d-flex justify-content-center align-items-center">
                <button type="submit" name="btn_register" class="btn utile1 border-utile1 text-white font-weight-bold shadow-sm">Créer compte</button>
            </div>
        </form>
    </div>
    <div class="bg-white col-4 pt-4">

        <div class="container bg-dark rounded-circle p-0" style="height: 150px; width: 150px; border-color: #51bfd0; border-width: 10px;">
            <img class="rounded-circle m-0" id="avatar" src="" alt="" style="height: 150px; width: 150px;">
        </div>
        <p class="text-center w-100">Avatar du joueur</p>
        <?php 
        if(isset($message)){
        ?>
        <div class="bg-danger rounded p-2 text-white text-center col-10 my-3 mx-auto"><?= $message ?></div>
        <?php
        }
        ?>
        <?php 
        if(isset($Success)){
        ?>
        <div class="bg-success rounded p-2 text-white text-center col-10 my-3 mx-auto"><?= $Success ?></div>
        <?php
        }
        ?>
    </div>

    <script type="text/javascript">

        const inputs = document.getElementsByTagName("input");
        for(let input of inputs){
            input.addEventListener("keyup", function(event){
                if(event.target.hasAttribute("error")){
                    //recuperer la valeur de l'atribut error
                    let idSmall = event.target.getAttribute("error")
                    //recuperer l'objet small
                    const errorSmall = document.getElementById(idSmall)
                    errorSmall.innerText = ""
                    input.style.borderColor = "black";
                    input.style.boxShadow = "none";
                }
            });
        }

        document.getElementById("form-inscription").addEventListener("submit", function(event){
            let valid = true;
            for(let input of inputs){
                if(!input.value.trim()){
                    valid = false;
                    
                    //
                    if(input.hasAttribute("error")){
                    //recuperer la valeur de l'atribut error
                    let idSmall = input.getAttribute("error")
                    //recuperer l'objet small
                    const errorSmall = document.getElementById(idSmall)
                    errorSmall.innerText = "Champ Obligatoire";
                    input.style.borderColor = "red";
                    input.style.boxShadow = "1px 1px 3px red";
                }
                }
            }
            if(valid == false){
                event.preventDefault();
                return false;
            }
        });

        // Chargement de l'image
        const imgUpload = document.querySelector("#imgUser");

        const prevUpload=()=>{
            // recuperation de l'image du champ
            let fileImg = imgUpload.files[0]
            console.log(fileImg)
            // transformer l'image en flux d'octets
            let reader = new FileReader();
            if(fileImg){
                reader.readAsDataURL(fileImg)
                reader.onloadend=function(){
                    const avatar = document.querySelector("#avatar")
                    avatar.src=reader.result
                }
            }
        }
        // ecouteur evenement
        imgUpload.addEventListener("change", prevUpload)

    </script>

</div>