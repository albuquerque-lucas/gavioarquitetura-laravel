<?php

namespace App\Services;

use App\Models\Project;
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
}
