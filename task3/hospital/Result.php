<?php
session_start();
// print_r($_SESSION['answer']);

$Qusetions = $_SESSION['Qusetions'];
$query = $_SESSION['query'];
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $totall = 0;
    foreach ($_SESSION['answer'] as $k => $v) {
        $totall += $v;
    }
    // echo $totall / 50;
} else {
    header("location:Review.php");
}

?>


<!doctype html>
<html lang="en">

<head>
    <title>Result</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <h2 class="text-danger text-capitalize text-center mt-3 h2 display-3 fw-bolder ">hospital</h2>
        <div class=" d-flex justify-content-center mt-5">
            <div class=" align-self-center">
                <table class="table table-striped table-bordered table-hover table-inverse table-responsive">
                    <thead class="thead-inverse table-thead-default">
                        <tr>
                            <th class="text-capitalize">Qusetion</th>
                            <th class="text-capitalize">Result</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($Qusetions as $k => $question) { ?>
                            <tr>
                                <td scope="row"><?= $question ?></td>
                                <?php
                                foreach ($query as $key => $val) {
                                    if ($_SESSION['answer']['answer' . $k] == $val) {
                                        $text = $key;
                                    }
                                }
                                ?>
                                <td scope="row"><?= $text ?></td>

                            </tr>
                        <?php } ?>
                        <tr>
                            <td scope="row"> Totall</td>
                            <td scope="row"> <?= (($totall / 50) > .50) ? " <h5 class='text-success fw-5'>Good</h5>" : " <h5 class='text-danger fw-5'>Bad</h5>" ?> </td>

                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
      <div class="w-50 mx-auto">
          <?= (($totall / 50) > .5) ? "<div class='alert alert-success'>Thank you</div>" : "<div class='alert alert-danger'>We will call you later on this phone {$_SESSION['Phone']} </div>" ?>
      </div>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>