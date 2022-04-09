<?php
session_start();
if(!isset($_SESSION['club']) ){
    header("location:Subscribe.php");
}

$sports = ["football", "swimming", "volleyball", "others"];

function td($val, $sports)
{
    foreach ($sports as $sport) {
        if (isset($val[$sport])) {
            echo "<td class='text-capitalize' scope='row'> $sport</td>";
        } else {
            echo "<td scope='row'></td>";
        }
    }
}
function TotallGames($tot)
{
    static $totall = 0;
    $totall += $tot;
    return ($totall);
}
function Games($val, $sports)
{
    static $GamesVals = ["football" => 0, "swimming" => 0, "volleyball" => 0, "others" => 0];
    foreach ($sports as $sport) {
        if (isset($val[$sport])) {
            $GamesVals[$sport] += $val[$sport];
        }
    }
    return $GamesVals;
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Club Result</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <h2 class="text-warning text-capitalize text-center mt-3 h2 display-3 fw-bolder ">Club...</h2>
        <div class="row mt-3 w-75 mx-auto">

            <div class="col">
                <?= $error ?? "" ?>
                <table class="table table-striped table-bordered table-hover table-inverse table-responsive">
                    <thead class="thead-inverse thead-default bg-info">
                        <tr>
                            <th>Subscriper </th>
                            <th colspan="5"><?= $_SESSION['name'] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION["club"] as $v) {
                            $totPric = 0;
                            echo "<tr>";
                            foreach ($v as  $val) {
                                if (gettype($val) == "string") {
                                    echo "<td scope='row'>$val</td>";
                                } else {
                                    $Tprice = 0;
                                    td($val, $sports);
                                    foreach ($val as $sport => $pri) {
                                        $Tprice += $pri;
                                    }
                                }
                                $games = Games($val, $sports);
                            }
                            $totPric = TotallGames($Tprice);
                            echo "<td scope='row'>$Tprice L.E</td>";
                            echo "</tr>";
                        }
                        ?>
                        <tr>
                            <td colspan="5" class="text-danger fw-bold">Totall</td>
                            <td class="text-success fw-bold"><?= $totPric; ?> L.E </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered  table-hover  table-responsive">

                    <?php

                    foreach ($sports as $sport) {
                        echo "<tr class='bg-success'>";
                        echo "<th class='fw-bold text-capitalize' colspan='5'> $sport Club</th>";
                        echo "<td class='fw-bold text-warning' > {$games[$sport]} L.E </td>";
                        echo "</tr>";
                    }
                    ?>

                    <tr class='bg-success'>
                        <th class='fw-bold text-capitalize' colspan='5'>club subscription</th>
                        <td class='fw-bold text-warning'>
                            <?= ($_SESSION['Num'] * 2500) + 10000 ?> L.E
                        </td>
                    </tr>

                    <tr class='bg-info'>
                        <th class='fw-bold text-capitalize text-success' colspan='5'>Totall Price</th>
                        <td class='fw-bold text-dark'>
                            <?= ($_SESSION['Num'] * 2500) + 10000 + $totPric ?> L.E
                        </td>
                    </tr>


                </table>


            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>