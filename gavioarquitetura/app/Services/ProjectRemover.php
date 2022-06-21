<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProjectRemover
{
    public function removeProject(int $project_id): string
    {
        $projectName = '';

        DB::transaction(function() use($project_id, &$projectName){
            $project = Project::find($project_id);

            Storage::disk('public')->delete($project->fotos);

            $project->images->each(function (Image $image){
                $imageName = $image->img_path;
                $storagePath = 'app/public/image-collections/';
                unlink(storage_path($storagePath . $imageName));
                $image->delete();
            });

            $projectName = $project->name;

            if($project->img_path)
            {
                Storage::disk('public')->delete($project->img_path);
            }

            $project->delete();


        });


        return $projectName;
    }
}
