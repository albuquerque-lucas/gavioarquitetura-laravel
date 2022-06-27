<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\ImageRemover;
use App\Services\ImageUploader;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request, ImageUploader $imageUploader)
    {
        $project_id = $request->id;
        $project = Project::find($project_id);
        $imageUploader->upload($request, 'images', $project, $project_id);

        return redirect()->back();
    }

    public function destroy(Request $request, ImageRemover $imageRemover)
    {
        $imageRemover->destroyImages($request->id);
        return redirect()->back();
    }
}
