<?php

namespace Codinari\Cardforge\Traits;

trait IsImageTrait{
    public function isImage($filePath){
        $imageInfo = getimagesize($filePath);
        return $imageInfo !== false;
    }
}