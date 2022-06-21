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
    protected $fillable = ['photo_path', 'projeto_id'];

    public function getPhotoPathUrlAttribute()
    {

        $baseDir = 'image-collections/';

        if($this->photo_path){
            return Storage::url($baseDir .$this->photo_path);
        }
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
