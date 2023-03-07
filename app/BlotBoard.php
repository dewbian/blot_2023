<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BlotBoardContent;

class BlotBoard extends Model
{
    protected $casts = [
        'bo_category' =>'json', 
    ]; 


    public function contents()
    {
        return $this->hasMany(BlotBoardContent::class,'bo_id'); 
    }
 
    public function getBoCategoryAttribute($value)
    {
       //dd("가져올때확인==>[".json_decode($value)."]");
       return array_values(json_decode($value, true) ?: []);
       //return "alongsatea";
    }

    public function setBoCategoryAttribute($value)
    {
       //var_dump("확인==>[".json_encode(array_values($value))."]");
       // $this->attributes['bo_category'] = json_encode(array_values($value));
       $this->attributes['bo_category'] = json_encode(array_values($value));
    }



    public function getBoCategoryUseAttribute($value)
    {
       //dd("가져올때확인==>[".json_decode($value)."]". "또는==>[". $value . "]");
       return array_values(json_decode($value, true) ?: []);
       //return "alongsatea";
    }


    
    public function setBoCategoryUseAttribute($value)
    { 
       $this->attributes['bo_category_use'] = json_encode(array_values($value));
    }




}
