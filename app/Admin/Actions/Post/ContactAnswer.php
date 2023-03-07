<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class ContactAnswer extends RowAction
{
    public $name = '답변';

    public function href()
    {  
        $editUrl = $this->getResource() . '/' . $this->getKey() . '/edit';   
        return $editUrl;
    } 
}