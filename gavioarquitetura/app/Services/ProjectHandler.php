<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProjectHandler
{
    public function createProject(string $name, string $area, string $year, string $address, $description, ?string $imgPath, string $categoryId, bool $activateCarousel) : Project
    {
        $project = Project::create([
            'name' => $name,
            'area' => $area,
            'year' => $year,
            'address' => $address,
            'description' => $description,
            'activate_carousel' => $activateCarousel,
            'category_id' => $categoryId,
            'img_path' => $imgPath
        ]);
        return $project;
    }

    public function uploadCover($request, $input)
    {
        $image = null;

        if($request->hasFile($input))
        {
            $image = $request->file($input)->store('project-cover', 'public');
        }

        return $image;
    }

    public function removeOldCover(Project $project)
    {
        if($project->img_path)
        {
            Storage::disk('public')->delete($project->img_path);
        }
    }

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
