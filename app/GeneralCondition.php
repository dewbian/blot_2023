<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralCondition extends Model
{
    protected $fillable = [
        'title',
    ];

    
    public function __construct(array $attributes = [])
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable("general_conditions");

        parent::__construct($attributes);
    }

}
