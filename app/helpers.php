<?php

if (! function_exists('getRoleBasedRoute')) {
    function getRoleBasedRoute($roleId, $type, $userId)
    {
        switch ($roleId) {
            case 1:
                $baseRoute = 'admins';
                break;
            case 2:
                $baseRoute = 'moderators';
                break;
            default:
                $baseRoute = 'volunteers';
                break;
        }

        switch ($type) {
            case 'index':
                return route("{$baseRoute}.index");
            case 'profile':
                return route("{$baseRoute}.profile", $userId);
            case 'changePassword':
                return route("{$baseRoute}.changePassword", $userId);
            case 'savePassword':
                return route("{$baseRoute}.savePassword", $userId);
            case 'editProfile':
                return route("{$baseRoute}.editProfile", $userId);
            case 'updateProfile':
                return route("{$baseRoute}.updateProfile", $userId);
            default:
                return '#';
        }
    }
}
