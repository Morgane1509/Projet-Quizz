<?php
$moisfr = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
$moiseng = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
$table = [];
$table['anglais'] = $moiseng;
$table['francais'] = $moisfr;


?>










<!doctype html>
<html lang="en">

<head>
    <title>Exercice 2 - Bases PHP</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <div class="form-group m-5 d-flex align-items-center justify-content-around">
                <p>Choisissez votre langue</p>
                <button type="submit" name="btn_submit" value="anglais" id="" class="btn btn-primary">Anglais</button>
                <button type="submit" name="btn_submit" value="francais" id="" class="btn btn-primary">Français</button>
            </div>
        </form>

        <table class="table table-bordered table-dark">
            <thead>
                <?php
                if (isset($_POST['btn_submit'])) {
                    $value = $_POST['btn_submit'];
                    if ($_POST['btn_submit'] === $value) {
                        foreach ($table[$value] as $key => $cell) {
                            if ($key % 3 === 0) {
                ?>
                                <tr>
                                    <th scope="col"><?= $key+1 ?></th>
                                    <td><?= $table[$value][$key] ?></td>
                                    <th scope="col"><?= $key + 2 ?></th>
                                    <td><?= $table[$value][$key + 1] ?></td>
                                    <th scope="col"><?= $key + 3 ?></th>
                                    <td><?= $table[$value][$key + 2] ?></td>

                                </tr>
                <?php
                            }
                        }
                    }
                }
                ?>

            </thead>
        </table>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>