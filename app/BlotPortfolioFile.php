<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BlotPortfolio;

class BlotPortfolioFile extends Model
{

    protected $fillable = [
         'po_file_url'
    ];


    public function portfolio()
    {
        return $this->belongsTo(BlotPortfolio::class,'id');
    }
}
