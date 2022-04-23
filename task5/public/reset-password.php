<?php
$title = "Reset Password";
include_once "../layouts/header.php";
include_once "../App/Middlewares/guest.php";
include_once "../layouts/nav.php";
include_once "../layouts/breadcrumb.php";
if(isset($_SESSION['errors'])){
}
// print_r($_SESSION);
?>

<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg2">
                            <h4> <?= $title ?> </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg2" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <?= getError('something'); ?>
                                    <?= getError('mail'); ?>
                                    <form action="../App/Http/Post/resetPassword.php" method="post">
                                    
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" placeholder="New Password" value="<?= old('password');?>">
                                            <?= getError('password'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">Password Confirmation</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" value="<?= old('password_confirmation');?>">
                                            <?= getError('password_confirmation'); ?>
                                        </div>
             
                                        <div class="button-box mt-5">
                                            <button type="submit"><span><?= $title ?></span></button>
                                        </div>
                                    </form>
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
?>