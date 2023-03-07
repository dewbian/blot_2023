<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BlotPortfolioFile;
use App\BlotPortfolioContents;

class BlotPortfolio extends Model
{
    protected $fillable = [
        //'po_type','po_subject'
    ];

    protected $casts = [
       // 'po_thumnail' =>'json',
    ];


    public function portfoilos()
    {
        return $this->hasMany(BlotPortfoliofile::class,'po_id');
    } 


    // public function contents1()
    // {
    //     return $this->hasMany(BlotPortfolioContents::class,'po_id');
    // } 

    public function getPoThumnailAttribute($value)
     {
        //dd("이곳에서~~~~==>[".array_values(json_decode($value, true) ?: [])."]");
        //$this->attributes['po_thumnail'] = json_encode($value); 
        return array_values(json_decode($value, true) ?: []);
     }

    public function setPoThumnailAttribute($value)
    { 
       // var_dump($value);
       //dd("여기서=====>[".json_encode($value)."]");
       // $this->attributes['po_thumnail'] = json_encode(array_values($value));
        $this->attributes['po_thumnail'] = json_encode($value); 
    }




} 
