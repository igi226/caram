<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Video;
class Contests extends Model
{
    use HasFactory;
    public $timestamps = true;
    public function contestVideos(){
        return $this->hasMany(Video::class, 'contest_id', 'id');

    }
    
}
