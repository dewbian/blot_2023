<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
 

class blot_config extends Model
{
     
    protected $fillable = [
        'cf_title', 'cf_admin_email', 'cf_admin_email_name', 
    ];

    
    public function __construct(array $attributes = [])
    {
        $connection = config('admin.database.connection') ?: config('database.default');

        $this->setConnection($connection);

        $this->setTable("blot_configs");

        parent::__construct($attributes);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    //protected $hidden = [
    //    'password', 'remember_token',
    //];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    //protected $casts = [
    //  'email_verified_at' => 'datetime',
    //];


}
