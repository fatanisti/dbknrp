<?php

function checkPermission($permissions){
    $userAccess = getMyPermission(auth()->user()->role);
    foreach ($permissions as $key => $value) {
        if($value == $userAccess){
            return true;
        }
    }
    return false;
}

function getMyPermission($id)
{
    switch ($id) {
        case 1:
            return 'adminUtama';
            break;
        case 2:
            return 'adminMaker';
            break;
        case 3:
            return 'adminDaerah';
            break;
        default:
            return 'adminFR';
            break;
    }
}

?>