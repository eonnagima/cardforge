<?php

namespace Codinari\Cardforge\Interfaces;

interface iFranchise{
    public function save();
    public static function getAll();
    public function franchiseExists($name);
    public function aliasExists($alias);
}