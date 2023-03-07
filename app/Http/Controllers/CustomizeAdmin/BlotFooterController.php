<?php
namespace App\Http\Controllers\CustomizeAdmin; 

use App\BlotFooter;
use Illuminate\Http\Request;
use Encore\Admin\Form;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Support\Facades\Redirect; 

class BlotFooterController extends AdminController
{

    protected function title()
    {
        return "푸터 관리";
    }


    protected function grid()
    {


        return Redirect::back()->with('message','Operation Success!!');

       // $userModel = config('admin.database.users_model'); 
        // $userModel = \App\blot_config::class; 
        // $grid = new Grid(new $userModel());

        // $grid->column('cf_title', 'cf_title')->editable()->sortable();
        // $grid->column('cf_admin_email', "관리자이메일");
        // $grid->column('name', trans('admin.name'));
        // $grid->column('roles', trans('admin.roles'))->pluck('name')->label();
        // $grid->column('created_at', trans('admin.created_at'));
        // $grid->column('updated_at', trans('admin.updated_at'));

        // $grid->actions(function (Grid\Displayers\Actions $actions) {
        //     if ($actions->getKey() == 1) {
        //         $actions->disableDelete();
        //     }
        // });

//        $grid->tools(function (Grid\Tools $tools) {
//            $tools->batch(function (Grid\Tools\BatchActions $actions) {
//                $actions->disableDelete();
//            });
//        });

      //  return $grid;
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
        $footerModel = BlotFooter::class;  

        $form = new Form(new $footerModel());
        $userTable = 'blot_footers';  
        $connection = config('admin.database.connection'); 
        $form->keyValue('content','푸터내용')->rules('required|min:1'); 

        // $form->text('cf_title', '홈페이지 제목')->rules('required');
        // $form->text('cf_admin_email', '관리자 메일 주소')->help('관리자가 보내고 받는 용도로 사용하는 메일 주소 (회원가입, 인증메일, 테스트, 회원메일발송 등에서 사용)')->rules('required');
        // $form->text('cf_admin_email_name', '관리자 메일 발송 이름')->help('관리자가 보내고 받는 용도로 사용하는 발송 이름 (회원가입, 인증메일, 테스트, 회원메일발송 등에서 사용)')->rules('required');  
        // $form->image('cf_sns_thumbnail', 'SNS 썸네일');
        // $form->image('cf_favicon_img', '파비콘');
        // $form->textarea('cf_allow_ip', '접근가능 IP')
        //      ->help('입력된 IP의 컴퓨터만 접근할 수 있습니다. 123.123.+ 도 입력 가능. (엔터로 구분)');  
        // $form->textarea('cf_block_ip', '접근차단 IP')
        //      ->help('입력된 IP의 컴퓨터는 접근할 수 없습니다. 123.123.+ 도 입력 가능. (엔터로 구분)');    
        // $form->textarea('cf_analysis_script', '방문자 분석 스크립트')
        //      ->help('방문자분석 스크립트 코드를 입력합니다. 예) 구글 애널리틱스');  
        // $form->textarea('cf_add_meta', '추가 메타태그')
        //      ->help('추가로 사용하실 meta 태그를 입력합니다.'); 
        // // $form->display('created_at', trans('admin.created_at'));
        // // $form->display('updated_at', trans('admin.updated_at'));

        //  $form->saving(function (Form $form) {
        //      if ($form->password && $form->model()->password != $form->password) {
        //          $form->password = Hash::make($form->password);
        //      }
        // });

        $form->tools(function (Form\Tools $tools) {
          // Disable `List` btn.
          $tools->disableList();  

          $tools->disableDelete();            
          // Disable `Veiw` btn.
          $tools->disableView(); 
        });

        $form->footer(function ($footer) { 
          // disable `View` checkbox
          $footer->disableViewCheck();
      
          // disable `Continue editing` checkbox
          $footer->disableEditingCheck();
      
          // disable `Continue Creating` checkbox
          $footer->disableCreatingCheck();        
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



}
