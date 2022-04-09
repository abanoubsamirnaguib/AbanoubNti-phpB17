<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST['name']) && !empty($_POST['Num'])) {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['Num'] = $_POST['Num'];
    header("location:Games.php");
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
    <div class="row mt-3 ">
      <div class="col-6 rounded">
        <img class="img-fluid rounded w-100" src="club.gif" alt="">
      </div>
      <div class="col-6  my-5">
        <?= $error ?? "" ?>
        <form method="post" > 
          <div class="my-auto">
            <label for="" class="form-label fw-bold text-warning text-capitalize">Member Name</label>
            <input type="text" class="form-control w-50" name="name" id="name" aria-describedby="name" placeholder="Member Name" value="<?= $_POST['name'] ?? ""; ?>">
          <small class="form-text text-muted">
            club subscription starts with <b>10,000 L.E</b>
          </small>
          </div>
          <div class="my-auto mt-5">
            <label for="" class="form-label fw-bold text-warning text-capitalize">Count of family members</label>
            <input type="number" class="form-control w-50" name="Num" id="Num" aria-describedby="Num" placeholder="Count of family members" value="<?= $_POST['Num'] ?? ""; ?>">
          <small class="form-text text-muted">
            cost of each member is <b>2,500 L.E</b>
          </small>
          </div>
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