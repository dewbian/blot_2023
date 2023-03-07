<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BlotPortfolio;

class BlotPortfolioContents extends Model
{

    protected $fillable = [
         'po_file_url'
    ];


    public function contents()
    {
        return $this->belongsTo(BlotPortfolio::class,'po_id');
    }
}
