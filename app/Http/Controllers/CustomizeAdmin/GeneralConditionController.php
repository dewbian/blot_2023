<?php
namespace App\Http\Controllers\CustomizeAdmin; 


use App\GeneralCondition;
use App\Http\Controllers\Controller; 
use Encore\Admin\Controllers\AdminController;
use Illuminate\Http\Request;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class GeneralConditionController extends AdminController
{

    /**
     * {@inheritdoc}
     */
    protected function title()
    {
        return "약관 관리";
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    { 
        $conditionModel = GeneralCondition::class; 

        $grid = new Grid(new $conditionModel());

        $grid->column('id', 'ID')->sortable();
        $grid->column('title', '제목'); 

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            if ($actions->getKey() == 1) {
                $actions->disableDelete();
            }
        });

//        $grid->tools(function (Grid\Tools $tools) {
//            $tools->batch(function (Grid\Tools\BatchActions $actions) {
//                $actions->disableDelete();
//            });
//        });

        return $grid; 
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        $conditionModel = GeneralCondition::class; 

        $show = new Show($conditionModel::findOrFail($id));

        $show->field('id', 'ID');    
        $show->field('title', '제목')->title()->as(function ($title) {
            return "{$title}";
        });  
        $show->field('content', '내용')->unescape(); 
        $show->field('created_at', trans('admin.created_at'));
        $show->field('updated_at', trans('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        $conditionModel = GeneralCondition::class; 
        $form = new Form(new $conditionModel());

        $form->display('id', 'ID');

        $form->text('title', '제목')->rules('required'); 
        $form->editor5('content', '내용')->rules('required'); 

        return $form;
    } 


}
