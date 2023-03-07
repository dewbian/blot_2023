<?php

namespace App\Http\Controllers\CustomizeAdmin;

use App\BlotContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;  
use Encore\Admin\Form;  
use Encore\Admin\Show;
use Encore\Admin\Grid;   
use Encore\Admin\Admin;   
use Encore\Admin\Layout\Content; 
use Encore\Admin\Layout\Row;
use Encore\Admin\Layout\Column;  
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form\NestedForm;
use App\Admin\Actions\Post\Replicate;
use App\Admin\Actions\Post\ContactAnswer;
use App\Admin\Actions\Post\ContactView;
use App\Mail\BlotCustomMail;
use Illuminate\Support\Facades\Mail;





class BlotContactController extends AdminController
{
 

    public function editCustomized($id, Content $content)
    { 
        $question = new BlotContact;
        $question = $question::find($id);

        return $content
            ->header('문의내용')
            ->row(BlotContact::detail_view($question))
            ->body($this->form()->edit($id)->render()) ;
    }
 
    public function showCustomized($id, Content $content)
    { 
        $question = new BlotContact;
        $question = $question::find($id);

        return $content
            ->header('문의내용')
            ->row(BlotContact::detail_view($question))
            ->row('<div style="right"><a href="/master/blot_contact">목록</a></div>');
    }


        public function index2($id, Content $content)
        {

            //$//question = new BlotContact;
            //$question = $question::find($id);
                        //$questionModel = new BlotContact::findOrFail($id);

            return $content
                ->header('프로젝트 문의 답변1111') 
                //->view('admin.question_contact',['aa' => $question  ])
               //->body( $this->show2($id)->render()) 
                ->body( $this->detail($id)->render()  )
                ->body( $this->form()->edit($id)->render()  );
            // return $content 
            //     ->description('Description...')
            //     ->row(Dashboard::title())
            //     ->row(function (Row $row) {

    
            //         $row->column(4, function (Column $column) {
            //             $column->append(Dashboard::environment());
            //         });
    
            //         $row->column(4, function (Column $column) {
            //             $column->append(Dashboard::extensions());
            //         });
    
            //         $row->column(4, function (Column $column) {
            //             $column->append(Dashboard::dependencies());
            //         });
            //     });
        } 
    
    public function form()
    {

        //$admin_user = Admin::user();
        //$username = $admin_user->username;
        $username = "관리자";

        $form = new Form(new BlotContact);   
        $form->textarea('con_answer_text', '답변내용');    
        $form->hidden('con_email');     

        $form->saving(function (Form $form) { 
        
            // $portfolioModel->setColumnNameAttribute ($form->po_thumnail);
            // dd( json_encode(array_values($form->con_answer_text)) );          
             //dd( $form->con_answer_text );          
            // Log::info('==================================nction makeTable=$bo_table==>['.$form->po_thumnail.']'); 
        });
        // callback after save
        $form->saved(function (Form $form) {
            //dd("저장 끝났어요==>".$form->con_answer_text);
			//dd("여기가 끝났어요==>[".$form->con_email."]" );
           // dd("여기에서 메일을 전송해야겠다. ");
           Mail::to("dewbian@naver.com")->send(new BlotCustomMail($form->con_answer_text, "AnswerToContact"));
        });

        $form->footer(function ($footer) {
            // disable reset btn
            $footer->disableReset();        
            // disable submit btn
            //$footer->disableSubmit();        
            // disable `View` checkbox
            $footer->disableViewCheck();        
            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();        
            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();      
        }); 
        $form->tools(function (Form\Tools $tools) {
            // Disable `List` btn.
            //$tools->disableList();        
            // Disable `Delete` btn.
            $tools->disableDelete();        
            // Disable `Veiw` btn.
            $tools->disableView(); 
        }); 


        return $form;
    }
    
    public function show2()
    {
        $show = new Show(new BlotContact);
    
        $show->field('con_manager', 'Field 11111');
        $show->field('con_company', 'Field 22222'); 
        return $show;

        
    }

    protected function detail($id)
    { 
        
        $show = new Show(BlotContact::findOrFail($id));
        //$show->divider();  
        $show->panel()
        ->title('세부내역')
        ->tools(function ($tools) {
            $tools->disableEdit();
            $tools->disableList();
            $tools->disableDelete();
        });
         
        $show->field('con_manager', trans('admin.username'));
        $show->field('con_company', trans('admin.name')); 
        return $show;
    }


    protected function title()
    {
        return "프로젝트 문의 관리";
    }


    public function index222()
{
    return Admin::content(function (Content $content) {

        // optional
        $content->header('page header');

        // optional
        $content->description('page description');

        // add breadcrumb since v1.5.7
        $content->breadcrumb(
            ['text' => 'Dashboard', 'url' => '/admin'],
            ['text' => 'User management', 'url' => '/admin/users'],
            ['text' => 'Edit user']
        );

        // Fill the page body part, you can put any renderable objects here
        $content->body('hello world');

        // Add another contents into body
        $content->body('foo bar');

        // method `row` is alias for `body`
        $content->row('hello world');

        // Direct rendering view, Since v1.6.12
        $content->view('dashboard', ['data' => 'foo']);
    });
}

    protected function grid()
    {  
       $grid = new Grid(new  BlotContact); 
       // $grid->disableTools();
       // $grid->disableFilter();
       // $grid->disableRowSelector();
        $grid->disableCreateButton(); 
       // $grid->disablePagination();
       // $grid->disableActions();
       $grid->disableColumnSelector();
       $grid->disableExport();

       $grid->filter(function($filter){
           // Remove the default id filter
           $filter->disableIdFilter();
           $filter->like('con_company', '회사명'); 
           $filter->like('con_manager', '담당자명'); 
           $filter->like('con_email', '담당자 이메일'); 
       }); 

       $grid->column('con_company', '회사명')->sortable();
       $grid->column('con_department', "담당부서")->sortable(); 
       $grid->column('con_manager', '담당자명')->sortable();
       $grid->column('con_tel', '연락처')->sortable(); 
       $grid->column('con_email', '이메일')->sortable(); 
       $grid->column('con_answerYN', '답변여부')->sortable(); 

       $grid->actions(function (Grid\Displayers\Actions $actions) { 
           $answerYN = $actions->row->con_answerYN;
           if($answerYN == 'Y'){              
                $actions->add(new ContactView); 
           }else{  
                $actions->add(new ContactAnswer); 
           } 
           $actions->disableEdit();
           $actions->disableView();
           $actions->disableDelete();
           //$actions->add(new Replicate); 
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
    // protected function form2()
    // {
    //     $form = new Form(new BlotContact);
    
    //     $form->text('field1', 'Field 1');
    //     $form->text('field2', 'Field 2');
    
    //     return $form;
    // }


    // public function form()
    // {
    //    $form = new Form(new BlotContact);
    //    $form->footer(function ($footer) {
    //     // disable reset btn
    //     //$footer->disableReset();    
    //     // disable submit btn
    //     //$footer->disableSubmit();    
    //     // disable `View` checkbox
    //     $footer->disableViewCheck();    
    //     // disable `Continue editing` checkbox
    //     $footer->disableEditingCheck();    
    //     // disable `Continue Creating` checkbox
    //     $footer->disableCreatingCheck();    
    //     }); 

    //     // $content =new Content;
    //     // $content->row(function (Row $row) {

    //     //     $row->column(4, 'xxx');
        
    //     //     $row->column(8, function (Column $column) {
    //     //         $column->row('111');
    //     //         $column->row('222');
    //     //         $column->row('333');
    //     //     });
    //     // }); 
    //     // echo $content;
    //    //$form->html($this->box());

    // //    $form->row(function ($row) {
    // //     $row->column(6, function ($form) {            
    // //         $form->display('con_company', '회사명')->readonly(); 
    // //         $form->display('con_manager', '담당자명'); 
    // //         $form->display('con_email', '이메일');
    // //     });
        
    // //     $row->column(6, 'Content 2');
    // // });

    // //     $form->column(1, function ($form) {            
    // //         $form->display('con_company', '회사명')->readonly(); 
    // //         $form->display('con_manager', '담당자명'); 
    // //         $form->display('con_email', '이메일');
    // //     });    
    //          $form->display('con_company', '회사명')->readonly(); 
    //          $form->display('con_manager', '담당자명'); 
    //          $form->display('con_email', '이메일');
        
    // //     $form->column(2, function ($form) {        
    // //         $form->display('con_department', '담당부서'); 
    // //         $form->display('con_tel', '연락처');  
    // //     }); 
    //     // $form->column(100, function ($form) {     
    //     //     $form->display('con_url', '홈페이지URL');
    //     //     $form->display('con_address', '회사주소');
    //     //     $form->display('con_service', '신청 서비스');
    //     //     $form->display('con_referrence01', '참고사이트01');
    //     //     $form->display('con_referrence02', '참고사이트02');
    //     //     $form->display('con_date', '오픈예상일');
    //     //     $form->display('con_budget', '예상 견적가');
    //     //     $form->display('con_page', '예상페이지수');
    //     //     $form->display('con_etc', '기타문의사항');
    //     //     $form->display('con_page', '예상페이지수');
    //     //     $form->file('con_file01', '첨부파일01');
    //     //     $form->file('con_file02', '첨부파일02');
    //     //     $form->textarea('con_answer', '답변')->rows(10)->rules('required'); 
    //     // }); 
 

    //    $form->saving(function (Form $form) {  
    //         dd("여기로 오믄 안되지.. 안돼.. 저장 끝났어요"); 
    //        // $portfolioModel->setColumnNameAttribute ($form->po_thumnail);
    //        // dd( json_encode(array_values($form->po_thumnail)) );          
    //        // Log::info('==================================nction makeTable=$bo_table==>['.$form->po_thumnail.']'); 
    //    });
    //    return $form;
    // }
 
    public function box()
    {
         
       return Content::content(function (Content $content) {
           $content->header('aaaa');

            $box = new Box('bbbb', '<pre>Lorem ipsum dolor sit amet</pre>');
             $content->row($box->collapsable());

           $box = new Box('cccc', '<p>Lorem ipsum dolor sit amet</p><p>consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>');
             $content->row($box->style('danger'));

             $box = new Box('dddd');
             $content->row($box->removable()->style('warning'));

        //     $headers = ['Id', 'Email', 'Name', 'age', 'Company'];
        //     $rows = [
        //         [1, 'labore21@yahoo.com', 'Ms. Clotilde Gibson', 25, 'Goodwin-Watsica'],
        //         [2, 'omnis.in@hotmail.com', 'Allie Kuhic', 28, 'Murphy, Koepp and Morar'],
        //         [3, 'quia65@hotmail.com', 'Prof. Drew Heller', 35, 'Kihn LLC'],
        //         [4, 'xet@yahoo.com', 'William Koss', 20, 'Becker-Raynor'],
        //         [5, 'ipsa.aut@gmail.com', 'Ms. Antonietta Kozey Jr.', 41, 'MicroBist'],
        //     ];

        //     $table = new Table($headers, $rows);

            $box = new Box('第四个容器', $table);
           $content->row($box->solid()->style('primary'));
        });
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
