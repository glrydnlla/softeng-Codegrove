<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgrammingLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'programming_language_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function programmingLanguage()
    {
        return $this->belongsTo(ProgrammingLanguage::class);
    }

}
