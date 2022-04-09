<?php
session_start();
if(!isset($_SESSION['Phone'])){
    header("location:Number.php");
}

$Qusetions = [
    "1- Are you satisfied with the level of cleanliness?",
    "2- Are you satisfied with the service prices?",
    "3- Are you satisfied with the nursing service?",
    "4- Are you satisfied with the level of the doctor?",
    "5- Are you satisfied with the calmness in the hospital?"
];
$query = [
    "bad" => 0,
    "good" => 3,
    "very good" => 5,
    "excellent" => 10
];
$_SESSION['Qusetions'] =$Qusetions;
$_SESSION['query'] =$query;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST) && count($_POST) == 5) {
        $_SESSION['answer'] = $_POST;
        header("location:Result.php");
    } else {
        $error = "<div class='alert alert-danger'>Please Answer All Questions</div>";
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <title>Review</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <div class="container">
    <h2 class="text-danger text-capitalize text-center mt-3 h2 display-3 fw-bolder ">hospital</h2>

        <div class="row d-flex align-items-center justify-content-center mt-5">
            <?= $error ?? "" ?>
            <form method="post">
                <table class="table table-striped table-bordered table-hover table-inverse table-responsive">
                    <thead class="thead-inverse table-thead-default">
                        <tr>
                            <th class="text-capitalize">Qusetion</th>
                            <?php
                            foreach ($query as $key => $val) {
                                echo "<th class='text-capitalize'>$key</th>";
                            }
                            ?>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        foreach ($Qusetions as $k => $question) { ?>
                            <tr>
                                <td scope="row"><?= $question ?></td>
                                <?php foreach ($query as $key => $val) {
                                    echo "<td class='text-capitalize'><input type='radio' name='answer$k' value='$val'></td>";
                                } ?>
                            </tr>

                        <?php } ?>


                    </tbody>
                </table>
                <button type="submit" class="btn btn-outline-info text-dark">Result</button>
            </form>
        </div>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>