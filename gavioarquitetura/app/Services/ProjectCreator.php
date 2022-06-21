<?php

namespace App\Services;

use App\Models\Project;

class ProjectCreator
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

    public function coverUpload($request)
    {
        $image = null;

        if($request->hasFile('img_path'))
        {
            $image = $request->file('img_path')->store('project-cover', 'public');
        }

        return $image;
    }
}
