<?php

require 'DB.php';

class Validator {

    public static function isValid($user) {
        if (!($user instanceof User)) return false;
        $result = DB::selectUserByUsername($user->getUsername());
        return $result && $user->getPassword() === $result[0]['password'];
    }

}