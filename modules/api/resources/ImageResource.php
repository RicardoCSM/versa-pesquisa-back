<?php

namespace app\modules\api\resources;

use app\models\Image;

class ImageResource extends Image
{
    public function uploadImage()
    {
        if ($this->validate()) {
            $this->name = $this->imageFile->baseName;
            $this->size = $this->imageFile->size;
            $this->path = 'storage/images/' . $this->name . '.' . $this->imageFile->extension;;
            if (!is_dir(dirname($this->path))) {
                mkdir(dirname($this->path), 0777, true);
            }
            $this->imageFile->saveAs($this->path);

            return true;
        } else {
            return false;
        }
    }

    public function deleteImage()
    {
        if (unlink($this->path)) {
            return true;
        }
        return false;
    }

}