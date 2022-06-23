<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\DB;

class ImageRemover
{
    public function destroyImages(int $image_id) : string
    {
        $imageName = '';
        $baseDir = 'app/public/image-collections/';

        DB::transaction(function() use ($image_id, &$imageName, $baseDir){
            $image = Image::find($image_id);
            $imageName = $image->img_path;
            $image->delete();

            if($image->img_path)
            {
                unlink(storage_path($baseDir . $imageName));
            }


        });
        return $imageName;
    }
}
