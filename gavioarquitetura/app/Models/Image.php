<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['img_path', 'project_id'];


    public function getPhotoPathUrlAttribute()
    {

        $baseDir = 'image-collections/';

        if($this->img_path){
            return Storage::url($baseDir .$this->img_path);
        }
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
