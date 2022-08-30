<?php

namespace App\Services;


use App\Models\Image;
use App\Models\Profile;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageHandler
{
    public function uploadProjectImages(Request $request, string $file_input, Project $project, int $project_id)
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

    public function uploadProfileImage(Profile $profile, Request $request)
    {
        Storage::disk('public')->delete($profile->img_path);
        $img = $request->file('img_path_profile')->store('users', 'public');
        $profile->img_path = $img;
        $profile->save();
    }


}
