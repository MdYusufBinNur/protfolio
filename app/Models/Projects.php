<?php

namespace MyProfile\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
   protected $guarded = [];
   public function category()
   {
       return $this->belongsTo(ProjectCategory::class);
   }
}
