<?php
if (!empty($_POST['number'])) {
    $unit = "";

    switch ($_POST['number']) {
        case $_POST['number'] <= 50:
            $unit = .50;
            break;
        case $_POST['number'] > 50 && $_POST['number'] <= 100:
            $unit = .75;
            break;
        case  $_POST['number'] > 100 && $_POST['number'] <= 200:
            $unit = 1.20;
            break;
        case $_POST['number'] > 200:
            $unit = 1.50;
            break;
        default:
            $result = "undefined operation";
    }
    $result = $unit;
} else {
    $result = "please fill the input";
}
?>
<!doctype html>
<html lang="en">

<head>
    <title> electricity </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="card border-primary w-50 mx-auto my-5">
        <div class="card-body text-center  mx-auto">
            <h4 class="card-title text-capitalize text-danger"> electricity </h4>
            <p class="card-text text-capitalize text-success p-2 rounded border border-success">get the price of electricity </p>
            <div class="container w-75 ">
                <form method="post" class="mx-auto ">
                    <div class="mb-3 row ">
                        <label for="inputName" class="col-sm-1-12 col-form-label"></label>
                        <div class="col-sm-1-12">
                            <input type="number" class="form-control text-center" name="number" id="number" placeholder="number">
                        </div>
                    </div>

                    <div class="mb-3 row ">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-outline-info text-capitalize"> result</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card text-left">
                <div class="card-header">
                    <h4 class="card-title text-center text-capitalize text-success">result</h4>
                </div>
                <?php if (!empty($_POST['number'])) { ?>
                    <div class="card-body">
                        <p class="card-text">Unit <?= $result ?></p>
                        <p class="card-text">Price <?= $_POST['number'] * $unit ?> L.E</p>
                        <p class="card-text">Bill 20%</p>
                    </div>
                    <div class="card-footer text-muted text-capitalize">
                        price after bill <?= ($unit *  $_POST['number']) * 1.20 ?> L.E
                    </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="card-footer text-muted text-capitalize">
        <?= $result ?>
    </div>
<?php } ?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>