<?php

namespace Codinari\Cardforge\Traits;

require_once __DIR__."/../../settings/config.php";

use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Api\Exception\ApiError;

trait ImageUploadTrait{
    public function imageUpload($filePath){
        try{
            $result = (new UploadApi())->upload($filePath, [
                'asset_folder' => 'cardforge',
                'user_filename' => false,
                'resource_type' => 'image'
            ]);
            return $result['secure_url'];
        }catch(ApiError $e){
            error_log('Upload failed: '.$e->getMessage());
            throw new \Exception('Upload failed: ' . $e->getMessage());
        }
    }
}