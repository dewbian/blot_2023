<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Painting;


class Painter extends Model
 
{
    public function paintings()
    {
        return $this->hasMany(Painting::class,'painter_id');
    }
}


?>