<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\DB;

class ImageRemover
{
    public function destroyImages(int $image_id) : string
    {
        $imageName = '';

        DB::transaction(function() use ($image_id, &$imageName){
            $image = Image::find($image_id);
            $imageName = $image->img_path;
            $image->delete();
            $storage_path = 'app/public/image-collections/';
            if($image->img_path)
            {
                unlink(storage_path($storage_path . $imageName));
            }


        });
        return $imageName;
    }
}
