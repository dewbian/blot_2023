<?php

namespace App\Http\Controllers\CustomizeAdmin; 

use App\BlotPortfolio; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use Encore\Admin\Form;
use Encore\Admin\Show;
use Encore\Admin\Grid; 
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form\NestedForm;
use App\Admin\Actions\Post\Replicate;
 

class BlotPortfolio3Controller extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     protected function title()
     {
         return "포트폴리오 관리_스타일3";
     }
 
     protected function grid()
     {
  
        $portfolioModel = BlotPortfolio::class;  
 
        $grid = new Grid(new $portfolioModel());
        // $grid->disableTools();
        // $grid->disableFilter();
        // $grid->disableRowSelector();
        // $grid->disableCreateButton(); 
        // $grid->disablePagination();
        // $grid->disableActions();
        $grid->disableColumnSelector();
        $grid->disableExport();

        $grid->filter(function($filter){
            // Remove the default id filter
            $filter->disableIdFilter();
            $filter->equal('po_type', '포트폴리오 타입'); 
        }); 

        $grid->column('po_type', '포트폴리오 타입')->sortable();
        $grid->column('po_subject', "프로젝트명")->sortable();
        $grid->column('po_begin_time','프로젝트 기간')->display(function () {
            return $this->po_begin_time .' ~ '.$this->po_end_time;
        });
        $grid->column('po_client', '클라이언트')->sortable();
        $grid->column('po_order', '노출순서')->sortable(); 
 
 
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
            $actions->add(new Replicate);
            // append an action.
            //$actions->append('<a href="ddd">여기서 추가해봐요</a>');
            // prepend an action.
            //$actions->prepend('<a href=""><i class="fa fa-paper-plane">'.$actions->getKey().'</i></a>');

            // if ($actions->getKey() == 1) {
            //     $actions->disableDelete();
            // }
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
     /**
      * Make a form builder.
      *
      * @return Form
      */
     public function form()
     {
        $form = new Form(new BlotPortfolio);
 
        $form->select('po_type', '포트폴리오타입')->rules('required')->options(['PC' => 'PC', 'MOBILE' => 'MOBILE', 'BTL' => 'BTL']);
        $form->text('po_subject', '프로젝트 이름')->rules('required');    
        $form->dateRange('po_begin_time', 'po_end_time', '프로젝트기간')->rules('required'); 

        $form->text('po_client', '클라이언트')->rules('required');    
        $form->url('po_client_url', '홈페이지URL');
        $form->tags('po_tag', '연관태그')->rules('required');     
        $form->number('po_order', '노출 순서')->rules('required')->min(1);
         

        // Subtable fields
        $form->hasMany('portfoilos', '', function (Form\NestedForm $form) {
            $form->image('po_file_url', '썸네일');
        });

        $form->text('po_head_summary', '헤드영역 요약')->rules('required');  
        $form->editor5('po_head_content', '헤드영역 내용'); 

        $form->radio('po_detail01','포트폴리오 #01')
        ->options([
            1 =>'이미지(파일등록)',
            2 =>'html',
        ])->when(1, function (Form $form) {    
            $form->image('po_detail01_img','');    
        })->when(2, function (Form $form) { 
            $form->text('po_detail01_text','');     
        })->default(1);

        
        $form->radio('po_detail02','포트폴리오 #02')
        ->options([
            1 =>'이미지(파일등록)',
            2 =>'html',
        ])->when(1, function (Form $form) {    
            $form->image('po_detail02_img','');    
        })->when(2, function (Form $form) { 
            $form->text('po_detail02_text','');     
        })->default(1);

        
        
        $form->radio('po_detail03','포트폴리오 #03')
        ->options([
            1 =>'이미지(파일등록)',
            2 =>'html',
        ])->when(1, function (Form $form) {    
            $form->image('po_detail03_img','');    
        })->when(2, function (Form $form) { 
            $form->text('po_detail03_text','');     
        })->default(1);
       
        
        $form->radio('po_detail04','포트폴리오 #04')
        ->options([
            1 =>'이미지(파일등록)',
            2 =>'html',
        ])->when(1, function (Form $form) {    
            $form->image('po_detail04_img','');    
        })->when(2, function (Form $form) { 
            $form->text('po_detail04_text','');     
        })->default(1);
       
        
        $form->radio('po_detail05','포트폴리오 #05')
        ->options([
            1 =>'이미지(파일등록)',
            2 =>'html',
        ])->when(1, function (Form $form) {    
            $form->image('po_detail05_img','');    
        })->when(2, function (Form $form) { 
            $form->text('po_detail05_text','');     
        })->default(1);
 
        // $form->hasMany('paintings', function (Form\NestedForm $form) { 
        //         $form->radio('field_name', 'Field Label')->options([
        //             'value1' => 'Option 1',
        //             'value2' => 'Option 2',
        //             'value3' => 'Option 3',
        //         ])->when('value1', function (Form $form) {        
        //             $form->image('body','ID card');        
        //         })->when('value2', function (Form $form) {        
        //             $form->text('title','Name');             
        //         }); 

        //     // $form->radio('paintings1111','Nationality')
        //     // ->options([
        //     //     1 =>'이미지파일',
        //     //     2 =>'html',
        //     // ])->when(1, function (Form $form) {        
        //     //     $form->image('body','ID card');        
        //     // })->when(2, function (Form $form) {        
        //     //     $form->text('title','Name'); 
        
        //     // });
        // });
        $form->saving(function (Form $form) { 
            // $portfolioModel->setColumnNameAttribute ($form->po_thumnail);
            // dd( json_encode(array_values($form->po_thumnail)) );          
            // Log::info('==================================nction makeTable=$bo_table==>['.$form->po_thumnail.']'); 
        });
        return $form;
     }
  
     public function save(Request $request)
     { 
         // $validated = request()->validate([
         //     'text' => 'required',
         //     'to' => 'required',
         //     'from' => 'required', 
         // ]);
 
         //$request->file('uploadFile')->store('images', 'public');
         //$file = $request->uploadFile->store('images');
         //return redirect()->route('admin.ConfigSetting');
         //  $validated = request()->validate([
         //     'cf_title' => 'required',
         //     'cf_admin_email' => 'required',
         //     'cf_admin_email_name' => 'required', 
         // ]);
         $message_result = blot_config::update(
             [
                 'cf_title' => $request->input('cf_title'),
                 'cf_admin_email' => $request->input('cf_admin_email'),
                 'cf_admin_email_name' => $request->input('cf_admin_email_name'),
             ]
         );
         //$message_result = blot_config::create($validated);
         // $message_result = blot_config::create([
         //     'cf_title' => $request->input('cf_title'),
         //     'cf_admin_email' => $request->input('cf_admin_email'),
         //     'cf_admin_email_name' => $request->input('cf_admin_email_name'),
         // ]);
  
         return Redirect::back()->with('message','Operation Success!!');
         //return redirect('뷰이름');
 
 
        // dump("message_result==>[".$message_result."]" );
 
         // dd("message_result".$message_result);
         // //return Redirect::back()->with('message',$message_result);
         // //return response() -> json([
         // //    'message_result' => $message_result
         // //] );
 
  
 
     } 


    ///////////////////////////// Called by API Method 
    public function getAllData()
    {
        $portfolioModel = BlotPortfolio::all(); 
        return response()->json($portfolioModel);
        //return response()->json("melong"); 
    }


    ///////////////////////////// Default Method 
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
    //  * @param  \App\BlotPortfolio  $blotPortfolio
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(BlotPortfolio $blotPortfolio)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\BlotPortfolio  $blotPortfolio
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(BlotPortfolio $blotPortfolio)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\BlotPortfolio  $blotPortfolio
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, BlotPortfolio $blotPortfolio)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\BlotPortfolio  $blotPortfolio
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(BlotPortfolio $blotPortfolio)
    // {
    //     //
    // }
}
