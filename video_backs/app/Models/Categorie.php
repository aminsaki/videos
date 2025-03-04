<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{

       protected $table='categories';
        protected $fillable=['name','slug' ,'description','parent_id'];
        protected $hidden=['created_at','updated_at'];


         public function links(): \Illuminate\Database\Eloquent\Relations\HasMany
         {
             return $this->hasMany(Link::class);
         }
}
