<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlotContact extends Model
{
   public static function detail_view($contact)
   {  
       return view('admin.blotcontact' , compact('contact'));
   }
 
    //public function getConAnswerTextAttribute($value)
    //{ 
       // var_dump($value);
       //dd("getConAnswerAttribute여기서=====>[".$value."]");
       // $this->attributes['po_thumnail'] = json_encode(array_values($value));
      //  $this->attributes['po_thumnail'] = json_encode($value); 
    //} 
    public function setConAnswerTextAttribute($value)
    { 
       // var_dump($value);
       //dd("setConAnswerAttribute 여기서=====>[".$value."]");

       $now = date('Y-m-d H:i:s');
       $this->attributes['con_answer_text'] = $value;
       $this->attributes['con_answerYN'] = 'Y';
       $this->attributes['con_answer_date'] = $now;
       $this->attributes['con_answer_id'] = $now;
    }


}
