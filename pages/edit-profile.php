<?php

if (!defined('ACCESS')) {
    die;
}

$user = new App\Library\User('student');

?>
<div class="container">
    <br>
    <div class="row">

        <?php include __DIR__.'/../profile-left-bar.php'; ?>

        <div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Profile</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                    <form class="form" action="##" method="post" id="registrationForm">
                        <?php
                        foreach ($user->personalInfo() as $key => $info) {
                            ?>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="<?= $key; ?>"><h4><?= $info['name']; ?></h4></label>
                                    <input type="text" class="form-control" name="<?= $key; ?>" id="<?= $key; ?>"
                                           placeholder="<?= $info['name']; ?>">
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        foreach ($user->contactInfo() as $key => $info) {
                            ?>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="<?= $key; ?>"><h4><?= $info['name']; ?></h4></label>
                                    <input type="text" class="form-control" name="<?= $key; ?>" id="<?= $key; ?>"
                                           placeholder="<?= $info['name']; ?>">
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <button class="btn btn-lg btn-success" type="submit"><i
                                            class="glyphicon glyphicon-ok-sign"></i> Save
                                </button>
                                <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr>

                </div><!--/tab-pane-->

            </div><!--/tab-pane-->
        </div><!--/tab-content-->

    </div><!--/col-9-->
</div>
