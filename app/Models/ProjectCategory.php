<?php

namespace MyProfile\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    protected $guarded = [];

    public function projects(){
        return $this->hasMany(Projects::class);
    }
}
