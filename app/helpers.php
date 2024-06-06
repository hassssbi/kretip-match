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
                return route("{$baseRoute}.profile");
            case 'changePassword':
                return route("{$baseRoute}.changePassword");
            case 'savePassword':
                return route("{$baseRoute}.savePassword");
            case 'editProfile':
                return route("{$baseRoute}.editProfile");
            case 'updateProfile':
                return route("{$baseRoute}.updateProfile");
            case 'events':
                return route("{$baseRoute}.events", $userId);
            default:
                return '#';
        }
    }
}
