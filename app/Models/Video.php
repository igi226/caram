<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id", "contest_id", "v_video", "v_slug","v_name"
    ];
    public $timestamps = true;
    public function videoOwner(){
        return $this->hasOne(User::class, 'id', 'user_id');

    }

    public function videoContest(){
        return $this->hasOne(Contests::class, 'id', 'contest_id');

    }
    // public function videoContest()
    // {
    //     return $this->belongsToMany(Contests::class);
    // }
}