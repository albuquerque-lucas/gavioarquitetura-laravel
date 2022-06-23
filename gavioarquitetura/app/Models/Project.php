<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'area',
        'year',
        'address',
        'description',
        'img_path',
        'category_id',
        'activate_carousel'
    ];

    public function getImgPathUrlAttribute()
    {

        $baseDir = 'project-cover/';

        if($this->img_path){
            return Storage::url($this->img_path);
        }
        return Storage::url($baseDir.'sem-imagem.jpg');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('activate_carousel', true);
    }
}
