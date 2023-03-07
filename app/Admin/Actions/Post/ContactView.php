<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class ContactView extends RowAction
{
    public $name = '보기';

    public function href()
    { 
             $editUrl = $this->getResource() . '/' . $this->getKey(); 
        return $editUrl;

    } 
}