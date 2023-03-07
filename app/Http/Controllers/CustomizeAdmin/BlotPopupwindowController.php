<?php

namespace App\Http\Controllers\CustomizeAdmin; 

use App\BlotPopupwindow;
use App\blot_config;
use Illuminate\Http\Request;
use Encore\Admin\Form;
use Encore\Admin\Show;
use Encore\Admin\Grid; 
use Encore\Admin\Controllers\AdminController;

class BlotPopupwindowController extends AdminController
{
    protected function title()
    {
        return "팝업 관리";
    }

    protected function grid()
    { 
        $popupModel = BlotPopupwindow::class; 

        $grid = new Grid(new $popupModel());

        $grid->disableColumnSelector();
        $grid->disableExport();
        $grid->column('id', 'ID')->sortable(); 

        $grid->column('title', '제목')->display(function($title) {
            return str_limit($title, 30, '...');
        })->sortable();


        $grid->column('pop_begin_time','노출기간')->display(function () {
            return $this->pop_begin_time .' ~ '.$this->pop_end_time;
        });
        $grid->column('pop_invisible', '노출상태')->released('pop_invisible?')->display(function ($released) {
            return $released ? '노출' : '미노출';
        })->sortable(); 
        
        $grid->column('pop_mobile', '노출기기')->sortable();
        
        $grid->column('created_at', '등록일')->sortable(); 

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
        $popupModel = BlotPopupwindow::class; 

        $show = new Show($popupModel::findOrFail($id));

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
        $popupModel = BlotPopupwindow::class; 
        $form = new Form(new $popupModel());


        $form->display('id', 'ID');  
        //$form->checkbox('pop_mobile' ,'노출기기')->options( [1 => '모바일'] );
        //$form->checkbox('pop_web' ,'PC')->options( [1 => 'PC'] );
        $form->datetimeRange('pop_begin_time', 'pop_end_time', '팝업게시기간')->rules('required'); 
 

        $cf_pop_controll = blot_config::first()->value('cf_pop_controll');
        // cf_pop_controll 1 : 슬라이드 2:개별팝업 

        if ( $cf_pop_controll == 2 ){
            $form->text('pop_height', '세로사이즈'); 
            $form->text('pop_width', '가로사이즈'); 
            $form->text('pop_top', '상단띄우기');  
            $form->text('pop_left', '좌측띄우기'); 
            // $form->column(1/2, function ($form) { 
            //         $form->text('pop_height', '세로사이즈'); 
            //         $form->text('pop_top', '상단띄우기');  
            // });
            // $form->column(1/2, function ($form) {
            //         $form->text('pop_width', '가로사이즈'); 
            //         $form->text('pop_left', '좌측띄우기'); 
            // });
        }       
        $form->radio('pop_invisible' , '팝업띄우기')->options(['1' => '즉시', '0'=> '팝업 띄우지않음'])->default('0');
        $form->text('title', '제목')->rules('required'); 
        $form->editor5('content', '내용')->rules('required'); 

        return $form;
    }  
}
