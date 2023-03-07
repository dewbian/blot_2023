<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BlotBoard;
use App\BlotBoardAttach;

class BlotBoardContent extends Model
{
    public function board()
    {
        return $this->belongto(BlotBoard::class,'id'); 
    }

    public function files()
    {
        return $this->hasMany(BlotBoardAttach::class,'content_id'); 
    }

}
