<?php
/** @var \App\Library\Database $db */
if (!defined('ACCESS')) {
    die;
}

$user = new App\Library\User('student', $db);

$result = $user->getUserById(1);
if (empty($result)) {
    include __DIR__.'/404.php';
    return;
}
?>
<div class="container">
    <br>
    <div class="row">

        <?php include __DIR__.'/../profile-left-bar.php'; ?>

        <div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Profile</a></li>
            </ul>

            <div class="tab-content profile">
                <div class="tab-pane active" id="home">
                    <hr>
                    <h4>Personal Information</h4>
                    <table class="table table-striped">
                        <tbody>
                        <?php
                        foreach ($user->personalInfo() as $key => $info) {
                            ?>
                            <tr>
                                <th scope="row"><?= $info['name']; ?>:</th>
                                <td><?= $result[$key] ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>

                    <h4>Contact Information</h4>
                    <table class="table table-striped">
                        <tbody>
                        <?php
                        foreach ($user->contactInfo() as $key => $info) {
                            ?>
                            <tr>
                                <th scope="row"><?= $info['name']; ?>:</th>
                                <td><?= $result[$key] ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <hr>
                </div><!--/tab-pane-->

            </div><!--/tab-pane-->
        </div><!--/tab-content-->

    </div><!--/col-9-->
</div>
