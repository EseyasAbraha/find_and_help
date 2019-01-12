<?php
if (!defined('ACCESS')) { die; }
?>
<div class="col-sm-3"><!--left col-->
    <div class="text-center profile">
        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
        <h2>User Name</h2>
        <a href="/?account-delete=yes" class="btn btn-danger">Remove My Account</a>
        <a href="/edit-profile" class="btn btn-info">Edit My Account</a>
        <a href="/?pick-me=12" class="btn btn-primary">Pick Me</a>
    </div>
    </hr>
    <br>

    <div class="panel panel-default profile">
        <div class="panel-heading">Notifications <i class="fa fa-link fa-1x"></i></div>
        <div class="panel-body">
            <ul>
                <li>
                    <a href="/profile?id=12">Sara</a> picked you as a teacher
                </li>
                <li>
                    <a href="/profile?id=12">Linda</a> picked you as a teacher
                </li>
            </ul>
        </div>
    </div>
</div><!--/col-3-->
