<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\ImageRemover;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $project_id = $request->id;
        $project = Project::find($project_id);
        $images = [];
        $fileRequest = $request->file('images');

        foreach ($fileRequest as $file){

            $name = time().rand(1, 100). '.' . $file->extension();
            $storage_path = 'app/public/image-collections';
            $file->move(storage_path($storage_path), $name);
            $project->images()->create(['img_path' =>  $name, 'project_id' => $project_id]);

        }

        return redirect()->back();
    }

    public function destroy(Request $request, ImageRemover $imageRemover)
    {
        $imageRemover->destroyImages($request->id);
        return redirect()->back();
    }
}
