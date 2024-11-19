<?php

namespace Codinari\Cardforge\Interfaces;

interface iUser{
    public function login();
    public static function validateLogin();
    public static function userExists($email);
    public static function isAdmin($email);
}