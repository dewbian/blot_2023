<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Painter;


class Painting extends Model
{
    public function painter()
    {
        return $this->belongsTo(Painter::class,'painter_id');
    }
}

?>