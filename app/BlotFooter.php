<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlotFooter extends Model
{
    //     
    protected $fillable = [
        'content','fillablecontent'
    ];

    protected $casts = [
        'content' =>'json',
        'fillablecontent' =>'json',
    ]; 


    
    public function __construct(array $attributes = [])
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable("blot_footers");

        parent::__construct($attributes);
    }

}
