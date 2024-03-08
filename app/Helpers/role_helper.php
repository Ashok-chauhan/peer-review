<?php

use CodeIgniter\CodeIgniter;

function roles()
{
    $db = \Config\Database::connect();
    $Q = $db->table('role');
    $result = $Q->get()->getResult();
    foreach ($result as $role) {
        $roles[$role->id] = $role->role;
    }
    return $roles;
}

function notifications()
{
    $db = \Config\Database::connect();
    $Q = $db->table('notifications');
    $Q->where('recipient_id', session()->get('userID'));
    $Q->where('status', 0);
    $Q->orderBy('date_created', 'DESC');
    $result = $Q->get()->getResult();
    if ($result) {
        return $result;
    } else {
        return null; //false;
    }
}


/**
 * Returns CodeIgniter's version.
 */
// function ci_version(): string
// {
//     return CodeIgniter::CI_VERSION;
// }
