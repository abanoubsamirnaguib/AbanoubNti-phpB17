<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST['name']) && !empty($_POST['loan']) && !empty($_POST['loanYear'] && $_POST['loanYear'] > 0 && $_POST['loan'] > 0)) {

    function calculate(float $per): array
    {
      $investRate = $_POST['loan'] * $_POST['loanYear'] * $per;
      $TotalLoan = $investRate + $_POST['loan'];
      $monNum = $_POST['loanYear'] * 12;
      return ["investRate" => $investRate, "TotalLoan" => $TotalLoan, "monNum" => $monNum];
    }

    if ($_POST['loanYear'] < 3 ) {
      $result = calculate(.10);
    } elseif ($_POST['loanYear'] < 30 && $_POST['loanYear'] >= 3) {
      $result = calculate(.15);
    } else {
      $error = "<div class='alert alert-danger'>Please Fill All Input</div>";
    }
  } else {
    $error = "<div class='alert alert-danger'>Please Fill All Input</div>";
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
    <h2 class="text-info text-capitalize text-center mt-3 h2 display-3 fw-bolder ">bank</h2>
    <div class="row mt-3">
      <div class="col-6 rounded">
        <img class="img-fluid rounded" src="loans.gif" alt="">
      </div>
      <div class="col-6">
        <?= $error ?? "" ?>
        <form method="post">
          <div class="mb-3">
            <label for="" class="form-label fw-bold text-info text-capitalize">Name</label>
            <input type="text" class="form-control w-75" name="name" id="name" aria-describedby="name" placeholder="name" value="<?= $_POST['name'] ?? ""; ?>">
          </div>
          <div class="mb-3">
            <label for="" class="form-label fw-bold text-info text-capitalize">loan amount</label>
            <input type="number" class="form-control w-75" name="loan" id="loan" aria-describedby="loan" placeholder="loan" value="<?= $_POST['loan'] ?? ""; ?>">
          </div>
          <div class="mb-3">
            <label for="" class="form-label fw-bold text-info text-capitalize">loan years</label>
            <input type="number" class="form-control w-75" name="loanYear" id="loanYear" aria-describedby="loanYear" placeholder="loanYear" value="<?= $_POST['loanYear'] ?? ""; ?>">
          </div>
          <button type="submit" class="btn btn-secondary text-center offset-5 my-2">Calculate</button>
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