<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','title','description','file_name', 'file_path','thumbnail_path', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
