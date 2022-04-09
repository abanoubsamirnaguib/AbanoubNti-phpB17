<?php
session_start();
// print_r($_POST);
if(!isset($_SESSION['name'])){
    header("location:Subscribe.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["club"] = $_POST["club"];
    $err = true;
    // print_r($_POST["club"][0]['name']);
    for ($r = 0; $r < count($_SESSION["club"]); $r++) {
        if (!isset($_POST["club"][$r]['sports'])) {
            $_SESSION["club"][$r]['sports'] = [];
        }
        if (!empty($_POST["club"][$r]['name'])) {
            $err = false;
        } else {
            $err = true;
            break;
        }
    }
    if (!$err) {
        header("location:Result.php");
    } else {
        $error = "<div class='alert alert-danger'>Please Fill All Inputs</div>";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Club</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <h2 class="text-warning text-capitalize text-center mt-3 h2 display-3 fw-bolder ">Club...</h2>
        <div class="row mt-3 w-50 mx-auto">

            <div class="col">
                <?= $error ?? "" ?>
                <form method="post">
                    <?php for ($i = 0; $i < $_SESSION['Num']; $i++) { ?>
                        <div class="my-auto">
                            <label for="" class="form-label fw-bold text-warning text-capitalize mt-1">Member <?= $i + 1 ?></label>
                            <input type="text" class="form-control w-50" name="club[<?= $i ?>][name]" id="name<?= $i + 1 ?>" aria-describedby="name[<?= $i + 1 ?>]" placeholder="Member Name <?= $i + 1 ?>" value="<?= $_POST['club'][$i]['name'] ?? "" ?>">
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="club[<?= $i ?>][sports][football]" id="football<?= $i + 1 ?>" value="300" <?= isset($_POST['club'][$i]['sports']['football']) ? "checked" : "" ?>>
                                <label class="form-check-label text-capitalize " for="football<?= $i + 1 ?>">
                                    football <b>300 l.E</b>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="club[<?= $i ?>][sports][swimming]" id="swimming<?= $i + 1 ?>" value="250" <?= isset($_POST['club'][$i]['sports']['swimming']) ? "checked" : "" ?>>
                                <label class="form-check-label text-capitalize " for="swimming<?= $i + 1 ?>">
                                    swimming <b>250 l.E</b>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="club[<?= $i ?>][sports][volleyball]" id="volleyball<?= $i + 1 ?>" value="150" <?= isset($_POST['club'][$i]['sports']['volleyball']) ? "checked" : "" ?>>
                                <label class="form-check-label text-capitalize " for="volleyball<?= $i + 1 ?>">
                                    volley ball <b>150 l.E</b>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="club[<?= $i ?>][sports][others]" id="Others<?= $i + 1 ?>" value="100" <?= isset($_POST['club'][$i]['sports']['others']) ? "checked" : "" ?>>
                                <label class="form-check-label text-capitalize " for="Others<?= $i + 1 ?>">
                                    Others <b>100 l.E</b>
                                </label>
                            </div>
                            <hr>
                        </div>
                    <?php } ?>
                    <button type="submit" class="btn btn-secondary text-center my-2">Subscribe</button>
                </form>


            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>