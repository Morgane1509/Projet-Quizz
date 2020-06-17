<div class="container p-2 w-100 col-8 m-auto rounded shadow bg-white d-flex flex-column justify-content-start align-items-stretch" style="height: 90%;">
    <h2 class="font-weight-bold text-center mb-3" style=" font-size:1.4em; color:#48d1cc;"> PARAMETRER VOTRE QUESTION</h2>

    <form method="post" action="<?=WEBROOT?>security/creerQuestion" id="questionCreateForm" class="rounded p-3" style="border:solid 1px #48d1cc;">
    <small class="text-danger" id="errorInputCreate"><?php if(isset($errorCreate['typeQuestion'])){ echo $errorCreate['typeQuestion']; } ?></small>
    <div class="form-group row">
            <label for="" class="col-sm-2 text-secondary font-weight-bold col-form-label m-auto" style="font-size:0.9em;"> Questions </label>
            <div class="col-sm-10">
                <textarea name="libelleQuestion" id="libelleQuestion" class="form-control rounded-0" style=" height:70px; box-shadow: 1px 1px #48d1cc; background-color:#f5f5f5;" placeholder="Entrez le libellé de la question" aria-describedby="helpId"></textarea>
                <small class="text-danger"><?php if(isset($errorCreate['libelleQuestion'])){ echo $errorCreate['libelleQuestion']; } ?></small>
            </div>
        </div>
        <div class="form-group row">
            <label for="nbrePoints" class="col-sm-3 text-secondary font-weight-bold col-form-label" style="font-size:0.9em;"> Nbre de Points </label>
            <input type="text" name="nbrePoints" id="nbrePoints" class="custom-select col-sm-2 rounded-0" style="box-shadow: 1px 1px #48d1cc; background-color:#f5f5f5;">
            <small class="text-danger"><?php if(isset($errorCreate['nbrePoints'])){ echo $errorCreate['nbrePoints']; } ?></small>
        </div>
        <div class="form-group row">
            <label for="typeQuestion" class="col-sm-3 text-secondary font-weight-bold  col-form-label" style="font-size:0.9em;"> Types de réponses </label>
            <select name="typeQuestion" id="typeQuestion" class="custom-select col-sm-7 rounded-0" style="box-shadow: 1px 1px #48d1cc; background-color:#f5f5f5;">
                <option value="cm">Choix multiple</option>
                <option value="cs">Choix simple</option>
                <option value="text">Texte</option>
            </select>
            <div class="col-sm-1" id="ajoutReponse">
                <img src="<?= WEBROOT ?>assets/images/Icônes/ic-ajout-réponse.png" alt="ajout reponse" style="margin-left:-10px; cursor: pointer;">
            </div>
            <small class="text-danger"><?php if(isset($errorCreate['typeQuestion'])){ echo $errorCreate['typeQuestion']; } ?></small>
        </div>
        <div class="form-group" id="champReponse">
            
        </div>

        <button type="submit" name="btn_create" onclick="validate()" class="btn btn-primary rounded-0 float-right" style="background-color:#48d1cc; border:none;">Enregistrer</button>
        <?php 
        if(isset($createSuccess)){
        ?>
        <div class="bg-success rounded p-2 text-white text-center col-5 my-3 mx-auto"><?= $createSuccess ?></div>
        <?php
        }
        ?>

        <?php 
        if(isset($createFailed)){
        ?>
        <div class="bg-danger rounded p-2 text-white text-center col-5 my-3 mx-auto"><?= $createFailed ?></div>
        <?php
        }
        ?>
    </form>
    

</div>

<script type="text/javascript" src="<?= WEBROOT ?>assets/js/creerQuestion.js"></script>