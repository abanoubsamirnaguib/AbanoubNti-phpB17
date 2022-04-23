<?php
$title = "My Account";
include_once "../layouts/header.php";
include_once "../App/Middlewares/auth.php";



// unset($_SESSION['old']);
include_once "../layouts/nav.php";
include_once "../layouts/breadcrumb.php";
?>
<!-- my account start -->
<div class="checkout-area pb-80 pt-100">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information </a></h5>
                            </div>
                            <div id="my-account-1" class="panel-collapse collapse <?= ($_SERVER['REQUEST_METHOD'] == 'GET' && (isset($_GET['changeInfo']) || isset($_GET['image']))) ? "show" : "" ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>My Account Information</h4>

                                            <h5>Your Personal Details</h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <?= getError('something') ?>
                                                <?= $_SESSION['success'] ?? "" ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-4 offset-4">
                                                <form method="post" action="../App/Http/Post/profile.php">
                                                    <?php if ($_SESSION['user']->image != 'default.jpg') { ?>
                                                        <button type="submit" class="close text-danger " name="removeImage" style="cursor: pointer;" aria-label="Close" title="Remove Profile Image">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    <?php } ?>
                                                    <label for="imageFile"><img src="../assets/img/users/<?= $_SESSION['user']->image ?>" id="pic" alt="" style="cursor:pointer;" class="w-100 rounded-circle"></label>
                                                </form>
                                            </div>

                                            <div class="col-4 offset-4">
                                                <form method="post" action="../App/Http/Post/profile.php" enctype="multipart/form-data" >

                                                    <input type="file" name="image" id="imageFile" class="form-control d-none" onchange="loadFile(event)">
                                                    <?= $_SESSION['errors']['size'] ?? "" ?> 
                                                    <?= $_SESSION['errors']['extension'] ?? "" ?> 
                                                    <button class="btn btn-success d-block mx-auto mt-3 rounded btn-sm" style="cursor: pointer;" id="changeImage" name="changeImage" disabled> Change Image</button>
                                                </form>
                                            </div>
                                        </div>

                                        <form method="post" action="../App/Http/Post/profile.php">
                                            <div class="row">

                                                <div class="col-lg-4 col-md-4">
                                                    <div class="billing-info">
                                                        <label>First Name</label>
                                                        <input type="text" name="first_name" value="<?= old('first_name') ?? $_SESSION['user']->first_name ?>">
                                                        <?= getError('first_name') ?>
                                                        <?= old('first_name') ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="billing-info">
                                                        <label>Last Name</label>
                                                        <input type="text" name="last_name" value="<?= old('last_name') ?? $_SESSION['user']->last_name  ?>">
                                                        <?= getError('last_name') ?>

                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="billing-info">
                                                        <label for="gender">Gender</label>
                                                        <select name="gender" class="form-control" id="gender">
                                                            <option <?= $_SESSION['user']->gender == 'm' ? 'selected' : '' ?> value="m">Male</option>
                                                            <option <?= $_SESSION['user']->gender == 'f' ? 'selected' : '' ?> value="f">Female</option>
                                                        </select>
                                                        <?= getError('gender') ?>

                                                    </div>
                                                </div>
                                                <div class="billing-back-btn">

                                                    <div class="billing-btn">
                                                        <button type="submit" name="update-profile">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
                                </div>
                                <div id="my-account-2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="billing-information-wrapper">
                                            <div class="account-info-wrapper">
                                                <h4>Change Password</h4>
                                                <h5>Your Password</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Password</label>
                                                        <input type="password">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Password Confirm</label>
                                                        <input type="password">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-back">
                                                    <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                </div>
                                                <div class="billing-btn">
                                                    <button type="submit">Continue</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title"><span>3</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Modify your address book entries </a></h5>
                                </div>
                                <div id="my-account-3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="billing-information-wrapper">
                                            <div class="account-info-wrapper">
                                                <h4>Address Book Entries</h4>
                                            </div>
                                            <div class="entries-wrapper">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                        <div class="entries-info text-center">
                                                            <p>Farhana hayder (shuvo) </p>
                                                            <p>hastech </p>
                                                            <p>Road#1 , Block#c </p>
                                                            <p>Rampura. </p>
                                                            <p>Dhaka </p>
                                                            <p>Bangladesh </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                        <div class="entries-edit-delete text-center">
                                                            <a class="edit" href="#">Edit</a>
                                                            <a href="#">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-back">
                                                    <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                </div>
                                                <div class="billing-btn">
                                                    <button type="submit">Continue</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title"><span>4</span> <a href="wishlist.php">Modify your wish list </a></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once "../layouts/footer.php";
include_once "../layouts/scripts.php";
unset($_SESSION['errors']);
unset($_SESSION['success']);

?>

<script>
    var loadFile = function(event) {
        var output = document.getElementById('pic');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
            var btn = document.getElementById('changeImage').removeAttribute('disabled');
        }
    };
</script>