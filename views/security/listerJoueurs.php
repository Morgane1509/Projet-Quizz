<?php

define("HOME", "http://localhost/Projet-Quizz/security/ListerJoueurs");

$pdo = new PDO('mysql:dbname=glrs_quizz;host=localhost', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$currentPage = (int)($GET['page'] ?? 1);
if($currentPage <= 0){
    die("Numero de page invalide");
}
$count = (int)$pdo->query('select count(id) from user')->fetch(PDO::FETCH_NUM)[0];
$perPage = 5;
$pages = ceil($count/12);
if($currentPage > $pages){
    die("Cette page n'existe pas");
}
$offset = $perPage * ($currentPage - 1);
$query = $pdo->query("select * from user where profil='joueur' order by id desc limit ".$perPage." offset ".$offset.";");
?>

<div class="container p-3 w-100 color5 col-8 m-auto rounded shadow bg-white d-flex flex-column justify-content-space-between align-items-stretch" style="height: 95%;">
    <h3 class="w-10 text-center mt-0 font-weight-bold font-italic">LISTE DES JOUEURS PAR SCORE</h3>
    <div class="m-2 p-2 h-75 border border-primary rounded" style="font-size: 15pt;">
        <table class="table table-borderless m-0 p-0 m-auto p-auto w-100">
            <thead>
                <tr>
                    <th scope="" class="p-0">Nom</th>
                    <th scope="" class="p-0">Prénom</th>
                    <th scope="" class="p-0">Score</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($joueur = $query->fetch()) {
                    $tab=explode(" ", $joueur["fullName"]);
                ?>
                    <tr>
                        <td class="p-0"><?= $tab[0] ?></td>
                        <td class="p-0"><?= $tab[1] ?></td>
                        <td class="p-0"><?= $joueur['score'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="w-100 d-flex justify-content-between my-4">
        <?php
        if ($currentPage > 1) {
            $link = HOME;
            if ($currentPage > 2) {
                $link .= '?page=' . ($currentPage - 1);
            }
        ?>
            <a href="<?= $link ?>" class="btn utile3 font-weight-bolder text-white">&laquo; Page précédente</a> <?php
        }
            if ($currentPage <= $pages) {
        ?> 
        <a href="<?= HOME ?>?page=<?= $currentPage + 1 ?>" class="btn utile3 ml-auto font-weight-bolder text-white">Page suivante &raquo; </a>
        <?php
        }
        ?>



    </div>

</div>