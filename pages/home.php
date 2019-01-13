<?php
if (!defined('ACCESS')) { die; }

use App\Library\Messages;
use App\Library\User;

if (User::isLoggedIn()) {
    header("location: /profile");
}
?>
<h1>Welcome to <?= APP_NAME; ?></h1>

<div class="row">
    <div class="col-md-12">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor eos id in ipsa natus quo quos sequi tempora voluptatum. Adipisci cum esse facere ipsa maiores neque possimus quas quasi vero!</div>
</div>
<br/>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">

                <form method="post" action="/?action=login" class="login">
                    <div class="form-group">
                        <label for="exampleInputEmail">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-default">Login</button>
                </form>

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default register">
            <div class="panel-heading">Become Member ኣባል ኩን</div>
            <div class="panel-body">
                <?=Messages::getFlashMessage(Messages::SUCCEED, 'register')?>
                <a href="/register?type=student" type="button" class="btn btn-info">As a Student ከም ተማሃራይ</a>
                <a href="/register?type=teacher" type="button" class="btn btn-primary">As a Teacher ከም መምህር</a>
            </div>
        </div>
    </div>
</div>
