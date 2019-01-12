<?php
if (!defined('ACCESS')) { die; }

use App\Library\UserTypes;

if (UserTypes::validType()) {
    return;
}

$user = new App\Library\User($_GET['type'], $db);

?>
<h1>Registration Wizard</h1>

<br/>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?= ucfirst($_GET['type']); ?></div>
            <div class="panel-body">


                <div class="stepwizard">
                    <div class="stepwizard-row setup-panel">
                        <div class="stepwizard-step">
                            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                            <p>Personal Info</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                            <p>Contact Info</p>
                        </div>
                        <div class="stepwizard-step">
                            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                            <p>Finish</p>
                        </div>
                    </div>
                </div>

                <form role="form" method="post" action="/?action=register">
                    <input type="hidden" name="type" value="<?=UserTypes::typeIndex($_GET['type'])?>">
                    <div class="row setup-content" id="step-1">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <h3> Personal Information</h3>
                                <input type="text" id="datepicker" />
                                <?php
                                foreach ($user->personalInfo() as $key => $info) {
                                    if (!isset($info['required']) || $info['required']) {
                                        $isRequired = '*';
                                        $required = ' required="required"';
                                    } else {
                                        $isRequired = '';
                                        $required = '';
                                    }
                                    if (isset($info['select']) && is_array($info['select'])) {
                                        $opt = '';
                                        foreach ($info['select'] as $indexKey => $value) {
                                            $opt .= '<option value="'.$indexKey.'">'.$value.'</option>';
                                        }
                                        $input = '<select name="'.$key.'" '.$required.' class="form-control">'.$opt.'</select>';
                                    } else {
                                        $input = '<input type="text" name="'.$key.'" '.$required.' class="form-control" placeholder="Enter '.$info['name'].'"  />';
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label class="control-label"><?= $info['name'].' '.$isRequired; ?></label>
                                        <?= $input; ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="row setup-content" id="step-2">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <h3> Contact Information</h3>
                                <?php
                                foreach ($user->contactInfo() as $key => $info) {
                                    if (!isset($info['required']) || $info['required']) {
                                        $isRequired = '*';
                                        $required = ' required="required"';
                                    } else {
                                        $isRequired = '';
                                        $required = '';
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label class="control-label"><?= $info['name']; ?></label>
                                        <input type="text" name="<?=$key?>" <?=$required?> class="form-control" placeholder="Enter <?= $info['name']; ?>"  />
                                    </div>
                                    <?php
                                }
                                ?>
                                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="row setup-content" id="step-3">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <h3> Finish</h3>
                                <p>By pressing Confirm! button you will accept our
                                    <a href="/conditions" target="_blank">terms & conditions</a> and you can use our ser service</p>
                                <button class="btn btn-success btn-lg pull-right" type="submit">Confirm!</button>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
