<?php
require_once("Validator.php");

$errors = [];
$t1 = [];
$t = [];
$nombre = "";


if (isset($_POST["btn_submit"])) {
    if ($_POST["btn_submit"] === "calcul") {
        $validator = new Validator();
        $nombre = $_POST['nombre'];

        $validator->is_empty($nombre, 'nombre');
        if ($validator->is_valid()) {
            $validator->sup10000($nombre, 'nombre');
            if ($validator->is_valid()) {
                while ($nombre > 0) {
                    if (Validator::estPremier($nombre) !== null) {
                        $t1[] = Validator::estPremier($nombre);
                    }
                    $nombre--;
                }
                foreach ($t1 as $i) {
                    if ($i < Validator::moyenne($t1)) {
                        $t['inferieur'][] = $i;
                    } else {
                        $t['superieur'][] = $i;
                    }
                }
            }
        }
        $errors = $validator->getErrors();
        if (isset($errors['nombre'])) {
            $nombre = "";
        }
    } else {
        $t1 = [];
    }
}

?>




<!doctype html>
<html lang="en">

<head>
    <title>Exercice 1 - Bases PHP</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid w-100">
        <form action="" method="post">
            <div class="form-group row m-2">
                <label for="inputNumber" class="col-sm-1-12 col-form-label">Nombre</label>
                <div class="col-6 ml-2">
                    <input type="text" class="form-control ml-2" name="nombre" value="<?= $nombre ?>" id="inputNumber" placeholder="Entrez un nombre superieur à 10000">
                </div>
                <?php if (isset($errors['nombre'])) {
                ?>
                    <div class="alert alert-danger col-4 ml-2">
                        <strong>Erreur</strong> <?php echo $errors['nombre'] ?>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="form-group row">
                <div class="offset-sm-2 col-sm-2">
                    <button type="submit" name="btn_submit" value="calcul" class="btn btn-primary">Calculer</button>
                </div>
                <div class="col-sm-2">
                    <button type="submit" name="btn_submit" value="reinitialisation" class="btn btn-secondary">Reinitialiser</button>
                </div>
            </div>

        </form>


        <table class="table table-striped table-dark mt-5">
            <thead>
                <tr>
                    <th scope="col" colspan="15" class="text-center">Premier</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $value = 'calcul';
                if (isset($_POST['btn_submit'])) {
                    if ($_POST['btn_submit'] === $value) {
                        if (empty($t1) === false) {
                            foreach ($t1 as $key => $cell) {
                                if ($key % 15 === 0) {
                ?>
                                    <tr scope="row">
                                        <td><?= $t1[$key] ?></td>
                                        <td><?= $t1[$key + 1] ?></td>
                                        <td><?= $t1[$key + 2] ?></td>
                                        <td><?= $t1[$key + 3] ?></td>
                                        <td><?= $t1[$key + 4] ?></td>
                                        <td><?= $t1[$key + 5] ?></td>
                                        <td><?= $t1[$key + 6] ?></td>
                                        <td><?= $t1[$key + 7] ?></td>
                                        <td><?= $t1[$key + 8] ?></td>
                                        <td><?= $t1[$key + 9] ?></td>
                                        <td><?= $t1[$key + 10] ?></td>
                                        <td><?= $t1[$key + 11] ?></td>
                                        <td><?= $t1[$key + 12] ?></td>
                                        <td><?= $t1[$key + 13] ?></td>
                                        <td><?= $t1[$key + 14] ?></td>
                                    </tr>
                <?php
                                }
                            }
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>