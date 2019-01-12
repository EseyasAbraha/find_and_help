<?php
if (!defined('ACCESS')) { die; }

define('APP_NAME', 'Help Finder');

include 'Database.php';
include 'UserTypes.php';
include 'User.php';
include 'Messages.php';

$db = new \App\Library\Database();
if (isset($_GET['action'])) {
    switch($_GET['action']) {
        case 'register':
            \App\Library\User::register($db);
            break;
        case 'login':
            \App\Library\User::login($db);
            break;
        case 'logout':
            \App\Library\User::logout();
            break;
    }
}
