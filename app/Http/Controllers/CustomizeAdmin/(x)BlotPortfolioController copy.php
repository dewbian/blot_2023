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

class BlotPortfolioController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     protected function title()
     {
         return "포트폴리오 관리";
     }
 
     protected function grid()
     {
  
        $portfolioModel = BlotPortfolio::class;  
 
        $grid = new Grid(new $portfolioModel());
  
        $grid->column('po_type', '포트폴리오 타입')->sortable();
        $grid->column('po_subject', "프로젝트명")->sortable();
        $grid->column('po_begin_time','프로젝트 기간')->display(function () {
            return $this->po_begin_time .' ~ '.$this->po_end_time;
        });
        $grid->column('po_client', '클라이언트')->sortable();
        $grid->column('po_order', '노출순서')->sortable(); 
 
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
            // append an action.
            //$actions->append('<a href="ddd">여기서 추가해봐요</a>');
// prepend an action.
//$actions->prepend('<a href=""><i class="fa fa-paper-plane">'.$actions->getKey().'</i></a>');

           // if ($actions->getKey() == 1) {
           //     $actions->disableDelete();
           // }
        });
 
        $grid->tools(function (Grid\Tools $tools) {
            //$tools->prepend('<a href=""><i class="fa fa-paper-plane">ㅁㅁㅁ</i></a>');
            // $tools->batch(function (Grid\Tools\BatchActions $actions) {
            //     $actions->disableDelete();
            // });
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
        $portfolioModel = BlotPortfolio::class; 
        $form = new Form(new $portfolioModel());  
         
        //$portfolioModel->getColumnNameAttribute ($form->po_thumnail);
        $form->select('po_type', '포트폴리오타입')->rules('required')->options(['PC' => 'PC', 'MOBILE' => 'MOBILE', 'BTL' => 'BTL']);
        $form->text('po_subject', '프로젝트 이름')->rules('required');    
        $form->dateRange('po_begin_time', 'po_end_time', '프로젝트기간')->rules('required'); 

        $form->text('po_client', '클라이언트')->rules('required');    
        $form->url('po_client_url', '홈페이지URL');
        $form->tags('po_tag', '연관태그')->rules('required');     
        $form->number('po_order', '노출 순서')->rules('required')->min(1);
         
         $form->table('po_thumnail','썸네일', function ($table) { 
            $table->image('Thum');
            $table->text('Desc');
         });

        //     $table->radio('po_thumnail','Nationality')
        //     ->options([
        //         1 =>'이미지파일',
        //         2 =>'html',
        //     ])->when(1, function (Form $form) {
         
        //         $form->image('po_thumnail','ID card');
        
        //     })->when(2, function (Form $form) {
        
        //         $form->text('po_head_content','Name'); 
        
        //     });
        // }); 

        // $form->hasMany('po_thumnail', function (NestedForm $form) {
        //     $form->text('title');
        //     $form->image('body');
        // });
 
        // $form->table('po_thumnail','썸네일', function ($table) { 
        //     $table->text('Explain'); 
        //     $table->file('img'); 
        // // }); 



        // $form->embeds('po_thumnail', '썸네일', function ($form) {
        //     //$form->image('Img');

            
        //     $form->multipleImage('Img')->removable();
        //     $form->text('Desc');
        // });
        // $form->text('po_head_summary', '헤드영역 요약')->rules('required');  
        // $form->editor5('po_head_content', '헤드영역 내용');   

         // $form->radio('po_tag','Nationality')
        // ->options([
        //     1 =>'이미지파일',
        //     2 =>'html',
        // ])->when(1, function (Form $form) {
        //     $form->image('po_thumnail','po_thumnail');
    
        // })->when(2, function (Form $form) {    
        //     $form->text('po_thumnail','po_thumnail');     
        // });
        $form->saving(function (Form $form) { 
         //  dd("melong==>[".$form->po_thumnail."]<br>");
          // dd($form->po_thumnail);
           //dd( array_values($form->po_thumnail) );
           // $portfolioModel->setColumnNameAttribute ($form->po_thumnail);
        //  dd( json_encode(array_values($form->po_thumnail)) );
 
           
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
