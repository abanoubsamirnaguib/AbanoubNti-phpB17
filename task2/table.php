<?php
include("data.php");

?>
<!doctype html>
<html lang="en">

<head>
    <title>Table</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <div class="container">

        <table class="mt-5 table table-striped table-bordered table-hover table-inverse table-responsive">
            <thead class="thead-inverse|thead-default">
                <tr>
                    <?php
                    foreach ($users as $user) {
                        foreach ($user as $key => $tabName) {
                            echo "<th>{$key}</th>";
                        }
                        break;
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $user) {
                    echo "<tr>";
                    foreach ($user as $key => $tabName) {
                        if (gettype($tabName) == "string" || gettype($tabName) == "integer") {
                            echo "<td>{$tabName}</td>";
                        } else {
                            $text = "";
                            foreach ($tabName as $key => $value) {
                                if (gettype($key) == "integer") {
                                    $num = $key + 1;
                                    $text .= "{$num} - $value ,<br>";
                                } else {
                                    if ($key == "gender") {
                                        $text .=  ($value == "m") ? "male" : "female";
                                    } else {
                                        $text .= "at $key is $value <br> ";
                                    }
                                }
                            }
                            echo "<td>{$text} </td>";
                        }
                    }
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>
<