<?php

namespace App\Http\Controllers\CustomizeAdmin;

use App\BlotRecruit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use Encore\Admin\Form;
use Encore\Admin\Show;
use Encore\Admin\Grid;  
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Column;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form\NestedForm;
use App\Admin\Actions\Post\Replicate;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;


class BlotRecruitController extends AdminController
{

    function title()
    {
        return "입사지원 관리";
    }

    protected function grid() //사용중
    { 
        $recruitModel = BlotRecruit::class; 

        $grid = new Grid(new $recruitModel());       
        $grid->disableColumnSelector();
        $grid->disableExport();
        $grid->disableCreateButton();

        $grid->filter(function($filter){
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->equal('rec_name', '지원자명'); 
            $filter->equal('rec_tel', '연락처'); 
            $filter->equal('rec_email', '이메일'); 
        }); 

        $grid->column('rec_type', '구분')->sortable(); 
        $grid->column('rec_department', '지원분야')->sortable(); 
        $grid->column('rec_name', '지원자명')->sortable(); 
        $grid->column('rec_tel', '연락처')->sortable(); 
        $grid->column('rec_email', '이메일')->sortable(); 
        $grid->column('rec_date', '출근가능일')->sortable();  


        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableEdit();
			//add actions
            //$actions->add(new Replicate); 
            // if ($actions->getKey() == 1) {
            //     $actions->disableDelete();
        });

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
//		 return Admin::content(function (Content $content) use ($id) {
//
//				$content->body(Admin::show(BlotRecruit::findOrFail($id), function (Show $show) {
//
//						$show->field('rec_type', '경력//신입');           
//						$show->field('rec_department', '지원분야');  
//						$show->field('rec_name', '지원자명');  
//						$show->field('rec_tel', '연락처');  
//						$show->field('rec_email', '이메일');  
//						$show->field('rec_date', '출근가능일');  
//						$show->field('rec_content', '상세내용'); 
//
//						$show->file('rec_file', '파일');  
//					
//						$show->field('created_at', trans('admin.created_at'));
//						$show->field('updated_at', trans('admin.updated_at'));
////						$show->panel()
////							->tools(function ($tools) {
////								$tools->disableEdit();
////								//$tools->disableList();
////								$tools->disableDelete();
////							});;
//
//				}));
//			});
        $recruitModel = BlotRecruit::class; 
        $show = new Show($recruitModel::findOrFail($id));

        $show->field('rec_type', '경력//신입');           
        $show->field('rec_department', '지원분야');  
        $show->field('rec_name', '지원자명');  
        $show->field('rec_tel', '연락처');  
        $show->field('rec_email', '이메일');  
        $show->field('rec_date', '출근가능일');  
        $show->field('rec_content', '상세내용');  
       // $show->file('rec_file', '파일');  
    $show->rec_file('첨부파일')->image();
    //$show->rec_file('첨부파일')->file();
        $show->field('created_at', trans('admin.created_at'));
        $show->field('updated_at', trans('admin.updated_at'));
		$show->panel()
			->tools(function ($tools) {
				$tools->disableEdit();
				//$tools->disableList();
				$tools->disableDelete();
			});;
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        $recruitModel = BlotRecruit::class; 
        $form = new Form(new $recruitModel()); 

        $form->text('rec_type', '경력/신입'); 
        $form->text('rec_department', '지원분야');  
        $form->text('rec_name', '지원자명'); 
        $form->mobile('rec_tel', '연락처'); 
        $form->text('rec_email', '이메일'); 
        $form->date('rec_date', '출근가능일'); 
        $form->text('rec_content', '상세내용'); 
        $form->file('rec_file', '파일'); 
 
        return $form;
    }  


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\BlotRecruit  $blotRecruit
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(BlotRecruit $blotRecruit)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\BlotRecruit  $blotRecruit
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(BlotRecruit $blotRecruit)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\BlotRecruit  $blotRecruit
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, BlotRecruit $blotRecruit)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\BlotRecruit  $blotRecruit
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(BlotRecruit $blotRecruit)
    // {
    //     //
    // }
}
