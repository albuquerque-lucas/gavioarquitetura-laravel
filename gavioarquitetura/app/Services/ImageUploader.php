<?php

namespace App\Services;


use Illuminate\Http\Request;

class ImageUploader
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
}
