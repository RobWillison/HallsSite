<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 8/17/16
 * Time: 1:06 PM
 */

namespace HallsApplication\Service;


use HallsApplication\Table\HallsImageTable;

class ImageService
{
    private $hallImageTable;
    
    public function __construct(HallsImageTable $hallsImageTable)
    {
        $this->hallImageTable = $hallsImageTable;
    }

    public function saveBase64Image($hallId, $imageString) {
        $directory = __DIR__ . '/../../../../public/img/hallsImages/';

        $type = explode(';', $imageString)[0];
        $extension = str_replace('data:image/', '', $type);


        $base64 = explode('base64,', $imageString)[1];
        $img = str_replace(' ', '+', $base64);

        $data = base64_decode($img);

        $fileName = uniqid() . '.' . $extension;

        $failure = file_put_contents($directory . $fileName, $data);
        
        if ($failure) {
            $this->addImageToHall($hallId, $fileName);
            return $fileName;
        }
        
        return false;
    }

    public function addImageToHall($hallId, $image) {
        $this->hallImageTable->insert(
            [
                'hallId' => $hallId,
                'imagePath' => $image,
            ]
        );
    }
}