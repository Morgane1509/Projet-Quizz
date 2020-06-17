<?php require_once("./views/layout/inc/header.inc.php"); 
?>



<div class="container p-0 d-flex align-items-start col-11 fixed-bottom fixed-top rounded shadow-sm bg-white" style="margin-top: 70px; margin-bottom: 10px;">

    <div class="position-relative w-100 d-flex justify-content-center align-items-center utile1">
        <div class="col-9 float-right">
            <div class="float-left d-flex flex-column">
                <div class="container bg-dark rounded-circle mt-1" style="height: 40px; width: 40px; border-color: #51bfd0; border-width: 10px;">

                </div>
                <p class="text-white"><?= $_SESSION['user']->getFullName() ?></p>
            </div>
            <h4 class="text-white font-weight-bold text-center float-right my-2 p-auto">BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ<br />JOUEZ ET TESTEZ VOTRE NIVEAU DE CULTURE GENERALE</h4>
        </div>
        <div class="col-3">
            <form action="" method="post">
                <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn float-right text-white utile3 shadow-sm mb-2" style="text-shadow: 1px 1px 2px black;">Deconnexion</button>
            </form>
        </div>
    </div>



    <div class="position-absolute row container w-100 m-0 d-flex justify-content-center align-items-center col-12 shadow-sm utile7 border-none" style="top: 13%; left: 0; right: 0; bottom: 0;">

        <div class="container p-3 w-100 color5 col-12 m-auto rounded shadow bg-white d-flex flex-row justify-content-space-between align-items-stretch" style="height: 95%;">

            <?php echo $content_for_layout; ?>


            <div class="container m-auto p-auto w-25 h-75 bg-white">
                <ul class="nav nav-tabs " id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="topscores-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Top Scores</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="meilleurscore-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Mon meilleur score</a>
                    </li>
                </ul>
                <div class="tab-content border border-top-0 h-75 shadow rounded-bottom" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="topscores-tab"></div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="meilleurscore-tab"></div>
                </div>
            </div>

        </div>

    </div>



</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Voulez-vous vraiment vous déconnecter ?
            </div>
            <form action="<?= WEBROOT ?>security/seDeconnecter" method="post">
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
                    <button type="submit" name="btn_logout" class="btn btn-success">Oui</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once("./views/layout/inc/footer.inc.php"); ?>