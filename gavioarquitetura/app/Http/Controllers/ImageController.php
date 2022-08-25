<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\ImageRemover;
use App\Services\ImageHandler;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request, ImageHandler $imageUploader)
    {
        $project_id = $request->id;
        $project = Project::find($project_id);
        $imageUploader->upload($request, 'images', $project, $project_id);

        return redirect()->back();
    }

    public function destroy(Request $request, ImageHandler $imageHandler)
    {
        $imageHandler->destroyImages($request->id);
        return redirect()->back();
    }
}
