<?php

function total($total)
{
  static $subtotal = 0;
  if (isset($_POST['Num'])) {
    $subtotal += $total;
    return $subtotal;
  }
  return $subtotal;
}


function totalAfterDIS($total)
{
  $dis = 0;
  switch ($total) {
    case $total <= 1000:
      $dis = 0;
      break;
    case $total <= 3000 && $total > 1000:
      $dis = .10;
      break;
    case $total <= 4500 && $total > 3000:
      $dis = .15;
      break;
    case $total > 4500:
      $dis = .20;
      break;
  }
  return ($total - ($total * $dis));
}
function delivery($delivery)
{
  $city = '';
  switch ($delivery) {
    case $delivery  == 0:
      $city = "cairo";
      break;
    case  $delivery == 30:
      $city = "Giza";
      break;
    case  $delivery == 50:
      $city = "Alex";
      break;
    case   $delivery == 100:
      $city = "Other";
      break;
  }
  return $city;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // print_r($_POST);
  if (!empty($_POST['name']) && !empty($_POST['Num'])) {
    $error = "";
  } else {
    $error = "<div class='alert alert-danger'>Please Fill All Input</div>";
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <title>Supermarket</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS v5.0.2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <div class="container-fluid">
    <h2 class="text-info text-capitalize text-center mt-3 h2 display-3 fw-bolder ">Supermarket</h2>
    <div class="row mt-3">
      <div class="col-6 rounded">
        <img class="img-fluid rounded w-100" src="supermarket.gif" alt="">
      </div>
      <div class="col-6">
        <?= $error ?? "" ?>
        <form method="post">
          <div class="mb-3">
            <label for="" class="form-label fw-bold text-info text-capitalize">User Name</label>
            <input type="text" class="form-control w-75" name="name" id="name" aria-describedby="name" placeholder="name" value="<?= $_POST['name'] ?? ""; ?>">
          </div>
          <div class="mb-3">
            <label for="" class="form-control-label fw-bold text-info text-capitalize">City</label>
            <select class="form-control w-75" name="city" id="">
              <option value="0" <?= (isset($_POST['city']) && ($_POST['city'] == '0')) ? "selected" : ""; ?>>Cairo </option>
              <option value="30" <?= (isset($_POST['city']) && ($_POST['city'] == '30')) ? "selected" : ""; ?>>Giza </option>
              <option value="50" <?= (isset($_POST['city']) && ($_POST['city'] == '50')) ? "selected" : ""; ?>>Alex </option>
              <option value="100 " <?= (isset($_POST['city']) && ($_POST['city'] == '100')) ? "selected" : ""; ?>>Other </option>
            </select>

          </div>
          <div class="mb-3">
            <label for="" class="form-label fw-bold text-info text-capitalize">Number Of Variation</label>
            <input type="number" class="form-control w-75" name="Num" id="Num" aria-describedby="Num" placeholder="Number Of Variation" value="<?= $_POST['Num'] ?? ""; ?>">
          </div>
          <button type="submit" class="btn btn-secondary text-center offset-5 my-2">Enter Product</button> <br>
          <?php
          if (isset($_POST['Num']) && empty($error)) { ?>
            <div class="container">
              <div class="row">
                <span class="col text-center text-danger fw-bold">Product name</span>
                <span class="col text-center text-danger fw-bold">Price</span>
                <span class="col text-center text-danger fw-bold">Quantity</span>
                <?php if (!empty($_POST['Quantity-1']))
                  echo "<span class='col text-center text-danger fw-bold'>sub Totall</span>";
                ?>

              </div>
              <br>
              <?php
              for ($i = 0; $i < $_POST['Num']; $i++) {
              ?>
                <div class="row my-2">
                  <!-- <span class="col mx-2 w-25 form-control"></span> -->
                  <input type="text" class="col mx-2 w-25 form-control" name="ProductName-<?= $i + 1 ?>" id="ProductName" aria-describedby="ProductName" placeholder="Product Name" value="<?= $_POST['ProductName-' . $i + 1] ?? ""; ?>" <?= isset($_POST['ProductName-' . $i + 1]) ? "disabled" : ""; ?>>
                  <input type="number" class="col mx-2 w-25 form-control" name="Price-<?= $i + 1 ?>" id="Price" aria-describedby="Price" placeholder="Price" value="<?= $_POST['Price-' . $i + 1] ?? ""; ?>" <?= isset($_POST['Price-' . $i + 1]) ? "disabled" : ""; ?>>
                  <input type="number" class="col mx-2 w-25 form-control" name="Quantity-<?= $i + 1 ?>" id="Quantity" aria-describedby="Quantity" placeholder="Quantity" value="<?= $_POST['Quantity-' . $i + 1] ?? ""; ?>" <?= isset($_POST['Quantity-' . $i + 1]) ? "disabled" : ""; ?>>
                  <?php if (!empty($_POST['Price-' . $i + 1]) && !empty($_POST['Quantity-' . $i + 1])) {
                    $subTot = $_POST['Price-' . $i + 1] * $_POST['Quantity-' . $i + 1];
                    $total = total($subTot);
                    echo "<span class='col mx-2 w-25 form-control'>$subTot</span>";
                  } ?>
                </div>
            <?php }
              if (!isset($subTot)) {
                echo "<button type='submit' class='btn btn-secondary text-center offset-5 my-2'>Receipt</button> <br>";
              }
              // echo isset($total) ? $total : "";
            } ?>
            </div>
        </form>

        <?php
        if (isset($subTot)) { ?>
          <table class='table table-striped table-bordered table-inverse table-responsive mt-5'>
            <tr>
              <th>user name</th>
              <td><?= $_POST['name'] ?? ""; ?></td>
            </tr>

            <tr>
              <th>City</th>
              <td><?= delivery($_POST['city']) ?? ""; ?></td>
            </tr>

            <tr>
              <th>total</th>
              <td><?= $total ?? ""; ?> L.E </td>
            </tr>

            <tr>
              <th>Discount</th>
              <td><?= $total - totalAfterDIS($total) ?> L.E </td>
            </tr>
            <tr>
              <th>total After Discount</th>
              <td><?= totalAfterDIS($total)  ?> L.E </td>
            </tr>

            <tr>
              <th>Delivery Fees</th>
              <td><?= $_POST['city']  ?> L.E</td>
            </tr>

            <tr>
              <th class="text-success fw-bold">Net Totall</th>
              <td class="text-danger fw-bold"><?= ($_POST['city'] + totalAfterDIS($total)) ?> L.E</td>
            </tr>


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