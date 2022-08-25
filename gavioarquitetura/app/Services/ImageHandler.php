<?php

namespace App\Services;


use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageHandler
{
    public function upload(Request $request, $file_input, $project, $project_id)
    {

        $images = [];
        $fileRequest = $request->file($file_input);

        foreach ($fileRequest as $file){

            $name = time().rand(1, 100). '.' . $file->extension();
            $storage_path = 'app/public/image-collections';
            $file->move(storage_path($storage_path), $name);
            $project->images()->create(['img_path' =>  $name, 'project_id' => $project_id]);

        }

            return $images;

    }

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
