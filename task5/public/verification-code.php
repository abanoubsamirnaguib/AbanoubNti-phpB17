<?php
$title = "Verification Code";
include_once "../layouts/header.php";
include_once "../layouts/nav.php";
include_once "../layouts/breadcrumb.php";
?>
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> <?= $title ?> </h4>
                        </a>

                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <?= getError('something'); ?>
                                <div class="login-register-form">
                                    <form action="../App/Http/Post/verifyCode.php?page=<?= $_GET['page'] ?>" method="post">
                                        <input type="number" name="code" placeholder="Code" value="<?= old('code') ?>">
                                        <?= getError('code') ?>
                                        <div class="button-box">
                                            <button type="submit"><span>Verify</span></button>
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