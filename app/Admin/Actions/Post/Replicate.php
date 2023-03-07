<?php

namespace App\Admin\Actions\Post;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Replicate extends RowAction
{
    public $name = '복사';

    public function handle(Model $model)
    {  
        $model->replicate()->save();
        return $this->response()->success(trans('admin.copy_succeeded'))->refresh();
    } 
    public function dialog()
    {
        $this->confirm(trans('admin.copy_confirm'));
    }


}