<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlotPopupwindow extends Model
{
   
    protected $fillable = [
        'content'
    ];
 

    
    public function __construct(array $attributes = [])
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable("blot_popupwindows");

        parent::__construct($attributes);
    }

}