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
        $project = Project::find($project_id);
        $projectName = $project->name;

        $this->removeImages($project_id);

        $project->delete();

        return $projectName;
    }

    protected function removeImages($project_id)
    {

        $imageName = '';
        $project = Project::find($project_id);

        DB::transaction(function() use($project, $project_id, $imageName){
            Storage::disk('public')->delete($project->fotos);

            $project->images->each(function (Image $image){
                $imageName = $image->img_path;
                $storagePath = 'app/public/image-collections/';
                unlink(storage_path($storagePath . $imageName));
                $image->delete();
            });
        });

        if($project->img_path)
        {
            Storage::disk('public')->delete($project->img_path);
        }

        return $imageName;

    }
}
