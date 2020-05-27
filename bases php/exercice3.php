<?php
require_once("Validator.php");
session_start();

if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = 0;
}
define('ORANGE', 'orange');
define('EXPRESSO', 'expresso');
define('FREE', 'free');
define('INVALIDE', 'invalide');
define('BTN_SUBMIT', 'btn_submit');
define('ENREGISTRER', 'enregistrer');
define('COMMENTAIRES', 'commentaires');

$errors = [];
$catalogue = [];
$catalogue[ORANGE] = [];
$catalogue[FREE] = [];
$catalogue[EXPRESSO] = [];
$catalogue[INVALIDE] = [];

$comments = "";

if (isset($_POST[BTN_SUBMIT])) {
    if ($_POST[BTN_SUBMIT] === ENREGISTRER) {
        if (isset($_POST['comments'])) {
            $comments = $_POST['comments'];
            $validator = new Validator();
            $validator->is_empty($comments, COMMENTAIRES);
            if ($validator->is_valid()) {
                $numbers = explode(" ", $comments);
                foreach ($numbers as $number) {
                    $validator->is_number($number, COMMENTAIRES);
                    if ($validator->is_valid()) {
                        $validator->is_telephone($number, 'telephone');
                        if ($validator->is_valid()) {
                            $id = $_SESSION['id'];
                            $id++;
                            $_SESSION['Resultat' . $id] = $number;
                            $_SESSION['id'] = $id;
                        } else {
                            $errors = $validator->getErrors();
                            if (isset($errors['telephone'])) {
                                $number = "";
                            }
                        }
                    }
                }
            }
            $errors = $validator->getErrors();
            if (isset($errors[COMMENTAIRES])) {
                $comments = "";
            }
        }

        foreach ($_SESSION as $key => $numero) {
            if ($key !== "id") {
                if (preg_match("#^7[78]#", $numero)) {
                    $catalogue[ORANGE][] = $numero;
                } elseif (preg_match("#^7[56]#", $numero)) {
                    $catalogue[FREE][] = $numero;
                } elseif (preg_match("#^70#", $numero)) {
                    $catalogue[EXPRESSO][] = $numero;
                } else {
                    $catalogue[INVALIDE][] = $numero;
                }
            }
        }
        if (array_key_exists('Resultat1', $_SESSION)) {
            $tailleCatalogue = count($catalogue[ORANGE]) + count($catalogue[FREE]) + count($catalogue[EXPRESSO]) + count($catalogue[INVALIDE]);
            $orangePercent = (count($catalogue[ORANGE]) / $tailleCatalogue) * 100;
            $freePercent = (count($catalogue[FREE]) / $tailleCatalogue) * 100;
            $expressoPercent = (count($catalogue[EXPRESSO]) / $tailleCatalogue) * 100;
            $invalidePercent = (count($catalogue[INVALIDE]) / $tailleCatalogue) * 100;
        }
    } else {
        $catalogue = [];
        session_destroy();
    }
}
?>



<!doctype html>
<html lang="en">

<head>
    <title>Exercice 3 - bases PHP</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container m-5">
        <form action="" method="post">
            <div class="w-100 text-center">
                <div class="form-group mb-3 d-flex align-items-center justify-content-around">
                    <label for="comments">n.Telephone</label>
                    <textarea class="form-control mx-5" name="comments" id="comments" rows="4" placeholder="Entrez les numeros de telephones"></textarea>
                    <?php if (isset($errors[COMMENTAIRES])) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Erreur</strong> <?= $errors[COMMENTAIRES] ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <button type="submit" name="btn_submit" value="enregistrer" id="" class="btn btn-primary">Enregistrer</button>
                <button type="submit" name="btn_submit" value="supprimer" id="" class="btn btn-danger">Supprimer</button>
            </div>
        </form>

        <table class="table table-borderd table-dark">
            <thead>
                <?php
                if (isset($_POST[BTN_SUBMIT])) {
                    if ($_POST[BTN_SUBMIT] === ENREGISTRER) {
                        foreach ($catalogue as $operateur => $groupNumbers) {
                ?>
                            <tr>
                                <?php
                                if ($operateur === ORANGE) {
                                ?>
                                    <td scope="col"><?= $operateur ?></td>
                                    <?php
                                    foreach ($catalogue[$operateur] as $tel) {
                                    ?>
                                        <td><?= $tel ?></td>
                                    <?php
                                    }
                                    ?>
                            </tr>
                        <?php
                                } elseif ($operateur === FREE) {
                        ?>
                            <td scope="col"><?= $operateur ?></td>
                            <?php
                                    foreach ($catalogue[$operateur] as $tel) {
                            ?>
                                <td><?= $tel ?></td>
                            <?php
                                    }
                            ?>
                            </tr>
                            <tr>
                            <?php
                                } elseif ($operateur === EXPRESSO) {
                            ?>
                                <td scope="col"><?= $operateur ?></td>
                                <?php
                                    foreach ($catalogue[$operateur] as $tel) {
                                ?>
                                    <td><?= $tel ?></td>
                                <?php
                                    }
                                ?>
                            <?php
                                }
                            ?>
                            </tr>
                <?php
                        }
                    }
                }   ?>
            </thead>
        </table>

        <div class="w-100 mt-5">
            <p class="w-100 text-left">
                <?php
                if (isset($_POST[BTN_SUBMIT])) {
                    if ($_POST[BTN_SUBMIT] === ENREGISTRER) {
                        if (array_key_exists('Resultat1', $_SESSION)) {
                ?>
                            Operateur Orange : <strong><?= $orangePercent ?></strong><br />
                            Operateur Free : <strong><?= $freePercent ?></strong><br />
                            Operateur Expresso : <strong><?= $expressoPercent ?></strong><br />
                            Numéros invalides : <strong><?= $invalidePercent ?></strong>
                <?php
                        }
                    }
                }
                ?>
            </p>
        </div>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>