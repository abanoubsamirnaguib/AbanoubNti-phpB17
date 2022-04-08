<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST['Phone'])) {
    $_SESSION['Phone'] = $_POST['Phone'];
    header("location:Review.php");
  } else {
    $error = "<div class='alert alert-danger'>Please Fill phone Number</div>";
  }
}

?>
<!doctype html>
<html lang="en">

<head>
  <title>Bank</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS v5.0.2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <div class="container-fluid">
    <h2 class="text-danger text-capitalize text-center mt-3 h2 display-3 fw-bolder ">hospital</h2>
    <div class="row mt-3 ">
      <div class="col-6 rounded">
        <img class="img-fluid rounded w-100" src="hospital.jpg" alt="">
      </div>
      <div class="col-6  my-5">
        <?= $error ?? "" ?>
        <form method="post" > 
          <div class="my-auto">
            <label for="" class="form-label fw-bold text-warning text-capitalize">Phone Number</label>
            <input type="text" class="form-control w-50" name="Phone" id="Phone" aria-describedby="Phone" placeholder="Phone Number" value="<?= $_POST['name'] ?? ""; ?>">
          </div>
          <button type="submit" class="btn btn-secondary text-center my-2">Next</button>
        </form>
        <?php
        if (isset($result['investRate'])) { ?>
          <table class='table table-striped table-bordered table-inverse table-responsive'>
            <thead>
              <tr>
                <th>user name</th>
                <th>interest rate</th>
                <th>loan after interest</th>
                <th>Monthly</th>
              </tr>
            </thead>
            <tbody>

              <tr>
                <td> <?= $_POST['name'] ?></td>
                <td> <?= $result['investRate']  ?></td>
                <td> <?= $result['TotalLoan']  ?></td>
                <td> <?= round($result['TotalLoan'] / $result['monNum'], 2) ?></td>
              </tr>
            </tbody>
          </table>
        <?php }  ?>

      </div>
    </div>
  </div>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>