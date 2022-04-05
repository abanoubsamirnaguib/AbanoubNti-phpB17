<?php
print_r($_POST);
$result;
if (
    !empty($_POST['Physics']) &&
    !empty($_POST['Chemistry']) &&
    !empty($_POST['Biology']) &&
    !empty($_POST['Mathematics']) &&
    !empty($_POST['Computer'])
) {
    define("Maxgrade", 250);
    $totallGrade = $_POST['Physics'] + $_POST['Chemistry'] + $_POST['Biology'] + $_POST['Mathematics'] + $_POST['Computer'];
    if (
        ($totallGrade < constant("Maxgrade") ) &&
        ($_POST['Physics'] <= 50 ) &&
        ($_POST['Chemistry'] <= 50 ) &&
        ($_POST['Biology'] <= 50 ) &&
        ($_POST['Mathematics'] <= 50 ) &&
        ($_POST['Computer'] <= 50 ) 
    ) {
        $logic = true;
        $Percentage = ($totallGrade / constant("Maxgrade")) * 100;
        $grade = "";
        switch ($Percentage) {
            case $Percentage < 40:
                $grade = "Grade F";
                break;
            case $Percentage >= 40 && $Percentage < 60:
                $grade = "Grade E";
                break;
            case  $Percentage >= 60 && $Percentage < 70:
                $grade = "Grade D";
                break;
            case  $Percentage >= 70 && $Percentage < 80:
                $grade = "Grade C";
                break;
            case  $Percentage >= 80 && $Percentage < 90:
                $grade = "Grade B";
                break;
            case $Percentage >= 90:
                $grade = "Grade A";
                break;
            default:
                $result = "undefined operation";
        }
    } else {
        $result = "grade is bigger than 50 each ";
    }
} else {
    $result = "please fill the input";
}
?>
<!doctype html>
<html lang="en">

<head>
    <title> grade </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="card border-primary w-50 mx-auto my-5">
        <div class="card-body text-center  mx-auto">
            <h4 class="card-title text-capitalize text-danger"> grade </h4>
            <p class="card-text text-capitalize text-success p-2 rounded border border-success">get the grade of student </p>
            <div class="container w-100 ">
                <form method="post" class="mx-auto ">
                    <div class="mb-3 row ">
                        <label for="inputName" class="col-sm-1-12 col-form-label"></label>
                        <div class="col-sm-1-12">
                            <input type="number" class="form-control text-center" name="Physics" id="Physics" placeholder="Physics grade">
                            <input type="number" class="form-control text-center" name="Chemistry" id="Chemistry" placeholder="Chemistry grade">
                            <input type="number" class="form-control text-center" name="Biology" id="Biology" placeholder="Biology grade">
                            <input type="number" class="form-control text-center" name="Mathematics" id="Mathematics " placeholder="Mathematics grade">
                            <input type="number" class="form-control text-center" name="Computer" id="Computer" placeholder="Computer grade">
                        </div>
                    </div>

                    <div class="mb-3 row ">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-outline-info text-capitalize"> result</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card text-left">
                <div class="card-header">
                    <h4 class="card-title text-center text-capitalize text-success">result</h4>
                </div>
                <?php if (isset($logic)  ) { ?>
                    <div class="card-body">
                        <p class="card-text">totallGrade <?= $totallGrade ?></p>
                        <p class="card-text">Percentage <?= $Percentage ?> % </p>
                        <p class="card-text">grade <?= $grade ?> </p>

                    </div>
                    <div class="card-footer text-muted text-capitalize">
                        result <?= "$totallGrade/250 $Percentage %  $grade" ?>
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