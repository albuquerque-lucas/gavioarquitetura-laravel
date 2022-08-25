<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'description',
        'img_path'
    ];

    public function getImgPathUrlAttribute()
    {

        $baseDir = 'users/';

        if($this->img_path){
            return Storage::url($this->img_path);
        }
        return Storage::url($baseDir.'sem-imagem.png');
    }
}
