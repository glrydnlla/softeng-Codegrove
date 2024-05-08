<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgrammingLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'programming_language_name',
        'programming_language_image_path'
    ];
    
    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function userProgrammingLanguage()
    {
        return $this->hasMany(UserProgrammingLanguage::class);
    }

}
