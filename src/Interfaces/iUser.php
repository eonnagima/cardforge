<?php

namespace Codinari\Cardforge\Interfaces;

interface iUser{
    public function save();
    public function verifyLogin($email, $pw);
}