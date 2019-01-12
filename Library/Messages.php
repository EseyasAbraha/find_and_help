<?php

namespace App\Library;

if (!defined('ACCESS')) { die; }

class Messages
{
    const ERROR = 0;
    const SUCCEED = 1;

    public static function setFlashMessage(int $type, string $scope, string $message)
    {
        $_SESSION["flash"][$type][$scope] = $message;
    }

    public static function getFlashMessage(int $type, string $scope)
    {
        if (!isset($_SESSION["flash"][$type][$scope])) {
            return '';
        }

        $msgType = 'danger';
        if ($type === self::SUCCEED) {
            $msgType = 'success';
        }
        $alert = '<div class="alert alert-'.$msgType.'" role="alert">'.$_SESSION["flash"][$type][$scope].'</div>';
        unset($_SESSION["flash"][$type][$scope]);
        return $alert;
    }

    public static function setClear()
    {
        unset($_SESSION['flash']);
    }
}
