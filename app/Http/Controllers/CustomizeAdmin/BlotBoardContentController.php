<?php

namespace App\Http\Controllers\CustomizeAdmin; 

use App\BlotBoard;
use App\Admin\Actions\Post\Replicate;
//use App\Admin\Actions\AddButton;
use Illuminate\Http\Request;
use App\BlotBoardContent;
use App\blot_config; 
use Encore\Admin\Form;
use Encore\Admin\Show;
use Encore\Admin\Grid; 
use Encore\Admin\Controllers\AdminController;
use Illuminate\Support\Facades\Redirect; 
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; 

class BlotBoardContentController extends AdminController
{
    protected function title()
    {
        return "게시물 관리";
    }

    protected function grid()
    { 
        $boardContentModel = BlotBoardContent::class; 

        $grid = new Grid(new $boardContentModel());
        $grid->disableColumnSelector();
        $grid->disableExport();

        //$grid->column('id', 'ID')->sortable(); 

        $grid->column('bo_id', '게시판')->width(150)->display(function($title) {
            return str_limit($title, 30, '...');
        })->sortable();

        $grid->column('member_id', '작성자');

        $grid->column('title', '게시판 제목')->width(700)->display(function($title) {
            return str_limit($title, 100, '...');
        })->sortable();
 
        $grid->column('created_at', '등록일')->sortable();         
         
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
            $actions->add(new Replicate);
        });
        // $grid->actions(function (Grid\Displayers\Actions $actions) {

        //     // 팝업 창에 표시될 내용을 정의합니다.
        //     $actions->popup('Popup Title', function ($popup) {
    
        //         // 팝업 창에 추가할 입력 요소를 정의합니다.
        //         $popup->select('select_field', 'Select Field')->options([
        //             'value1' => 'Label1',
        //             'value2' => 'Label2',
        //             'value3' => 'Label3',
        //         ]);
    
        //         // 팝업 창에서 확인 버튼을 클릭할 때 실행될 로직을 정의합니다.
        //         $popup->confirm('Are you sure?', function ($popup) {
    
        //             // 선택한 값을 이용하여 리다이렉션합니다.
        //             $value = $popup->input('select_field');
        //             return redirect()->route('route.name', ['value' => $value]);
        //         });
        //     });
        // });

        $grid->tools(function (Grid\Tools $tools){
            $tools->append(new AddButton());
        });
        $options = ['aa'=>'bb'];
        // $grid->tools([
        //     '<a class="btn btn-sm btn-success" href="/add">Addaaaaaaaaaaaaaaaaaaaaaaa</a>',
        // ]);

            // $grid->tools(function (Grid\Tools $tools) use ($options) {
            // $tools->append('<a class="btn btn-sm btn-success" href="/add">Addaaaaaaaaaaaaaaaaaaaaaaa</a>');
            //     }); 

        // $grid->tools(function (Grid\Tools $tools) use ($options) {
        //     $tools->append(new Replicate);
        // }); 
 
//     $grid->tools(function (Grid\Tools $tools) use ($options) {
//         $tools->append(new MyCreateButton($options));

// $grid->tools(function (Grid\Tools $tools) {
//     $tools->append(new AddButton());
// });
        
//     });
    
    // $grid->tools(function (Grid\Tools $tools) {
    //     $tools->append(new App\Admin\Actions\AddButton());
    // });


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
        $boardContentModel = BlotBoardContent::class; 

        $show = new Show($boardContentModel::findOrFail($id));

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
        $boardContentModel = BlotBoardContent::class; 
        $form = new Form(new $boardContentModel());
 
        // // Subtable fields
        // $form->hasMany('portfoilos', '', function (Form\NestedForm $form) {
        //     $form->image('po_file_url', '썸네일');
        // });
        //$form->select('bo_id', '게시판제목')
        //->options($this->getBoardSelect());

		 
        $form->select('bo_id', '게시판')->rules('required')
        ->options(['News' => 'News', 'Events' => 'Events']);

        $form->text('created_at', '최초등록일'); 
        $form->text('updated_at', '최종수정일');       
        $form->text('title', '제목')->rules('required'); 
        $form->editor5('content', '내용')->rules('required'); 
        $form->number('order', '노출순서')->min(1);     
        $form->checkbox('display', '노출')->options( ['Y' => '노출']);

        // $form->embeds('column_name', function ($form) {

        //     $form->text('key1','aa')->rules('required');
        //     $form->email('key2')->rules('required');
        //     $form->datetime('key3');
        
        //     $form->dateRange('key4','key5','Range')->rules('required');
        // });


        // $form->table('bo_category', '카테고리', function ($table) { 
        //     $table->text('category1');
        //     $table->text('category2');
        // });

        //$form->checkbox('pop_mobile' ,'노출기기')->options( [1 => '모바일'] );
        //$form->checkbox('pop_web' ,'PC')->options( [1 => 'PC'] );  
        

        // $form->multipleSelect('http_method', trans('admin.http.method'))
        // ->options($this->getSkinSelect())
        // ->help(trans('admin.all_methods_if_empty'));
       //array_combine("bb" )


  //접속기기
    //    $form->radio('pop_invisible' , '팝업띄우기')->options(['1' => '즉시', '0'=> '팝업 띄우지않음'])->default('0');

       // $form->editor5('content', '내용')->rules('required'); 

        $form->saving(function (Form $form) {

        //dd("use==>[".json_encode($form->bo_category_use)."]");

            \DB::enableQueryLog(); 

           // $this->makeTable($form->bo_table);

        });
        $form->saved(function (Form $form) {
            //dd("ㅋㅋ".\DB::getQueryLog());

        });

        return $form;
    }  



// 스킨디렉토리를 SELECT 형식으로 얻음
protected function getSkinSelect()
{ 
    $skins = array();
    $dirpath = 'boradeditor/'.date('Ym');
    dd("public_path===>[".'public/'.$dirpath.'/'.$file_name."]"); 


    if (defined('G5_THEME_PATH') && $config['cf_theme']) {
        $dirs = get_skin_dir($skin_gubun, G5_THEME_PATH . '/' . G5_SKIN_DIR);
        if (!empty($dirs)) {
            foreach ($dirs as $dir) {
                $skins[] = 'theme/' . $dir;
            }
        }
    }

    $skins = array_merge($skins, get_skin_dir($skin_gubun));

    $str = "<select id=\"$id\" name=\"$name\" $event>\n";
    for ($i = 0; $i < count($skins); $i++) {
        if ($i == 0) {
            $str .= "<option value=\"\">선택</option>";
        }
        if (preg_match('#^theme/(.+)$#', $skins[$i], $match)) {
            $text = '(테마) ' . $match[1];
        } else {
            $text = $skins[$i];
        }

        $str .= option_selected($skins[$i], $selected, $text);
    }
    $str .= "</select>";
    return $str;
}

 

//테이블 만들기 
protected function makeTable($bo_table)
{

    Log::info('C:\blot_2022\app\Http\Controllers\CustomizeAdmin\BlotBoardContentController.php function makeTable=$bo_table==>['.$bo_table.']'); 
    $createUsersTable = Schema::create('blot_board_'.$bo_table, function ($table) { 
        $table->bigIncrements('id');
        $table->string('name');
        $table->string('email');
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });

    //$sql = $createUsersTable->toSql();    

    //$queries = DB::getQueryLog();
    //dd($queries);

    //dd('C:\blot_2022\app\Http\Controllers\CustomizeAdmin\BlotBoardContentController.php function makeTable===>['.'blot_board_'.$bo_table.']'); 
}

}


class MyCreateButton extends Grid\Tools\CreateButton
{
    protected $options;

    public function __construct($options)
    {
        $this->options = $options;
    }

    protected function href()
    {
        return "javascript:;";
    }

    public function render()
    {
        //$this->setupScript();

        //$create = trans('admin.create');

        $text = "이로케"; //$this->getText();

        $options = json_encode($this->options);

        return <<<EOT
<div class="btn-group pull-right" style="margin-right: 10px">
    <a class="btn btn-sm btn-success" id="create-btn"><i class="fa fa-plus"></i>&nbsp;&nbsp;{$text}</a>
</div>

<script>
$(function () {
    $('#create-btn').click(function () {
        alert('melong');
        $('#form-modal').modal();
        // LA.Request({
        //     url: '/create',
        //     data: {
        //         _editable: 1,
        //         _popup: 1,
        //     },
        //     success: function (data) {
        //         $('#form-modal .modal-content').html(data);
        //         $('#form-modal').modal();
        //     }
        // });
    });
});
</script>
EOT;
    }


    protected function getSkinSelect()
    { 
        $skins = array();
        $dirpath = 'boradeditor/'.date('Ym');
        dd("public_path===>[".'public/'.$dirpath.'/'.$file_name."]"); 
    
    
        if (defined('G5_THEME_PATH') && $config['cf_theme']) {
            $dirs = get_skin_dir($skin_gubun, G5_THEME_PATH . '/' . G5_SKIN_DIR);
            if (!empty($dirs)) {
                foreach ($dirs as $dir) {
                    $skins[] = 'theme/' . $dir;
                }
            }
        }
    
        $skins = array_merge($skins, get_skin_dir($skin_gubun));
    
        $str = "<select id=\"$id\" name=\"$name\" $event>\n";
        for ($i = 0; $i < count($skins); $i++) {
            if ($i == 0) {
                $str .= "<option value=\"\">선택</option>";
            }
            if (preg_match('#^theme/(.+)$#', $skins[$i], $match)) {
                $text = '(테마) ' . $match[1];
            } else {
                $text = $skins[$i];
            }
    
            $str .= option_selected($skins[$i], $selected, $text);
        }
        $str .= "</select>";
        return $str;
    }
    


}



use Encore\Admin\Grid\Tools\AbstractTool;
use Encore\Admin\Widgets\Form as wigetForm; 

class AddButton extends AbstractTool
{
    public function render()
    {
        $form = new wigetForm();

        $form->select('category', '카테고리')->options([
            'option1' => '옵션1',
            'option2' => '옵션2',
            'option3' => '옵션3',
        ]);

        $form->setWidth(4, 4); 
        return <<<HTML
<div class="btn-group pull-right" style="margin-right: 10px">
    <a class="btn btn-sm btn-twitter" id="add-dataaa" title="Add new">
        <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;Add new</span>
    </a>
</div>
HTML;
    } 
    protected function script()
    {
        $route = route('admin.posts.create');

        return <<<EOT
$('#add-dataaa').on('click', function() {
    alert('melong');
// LA.Request.modal({
//     'title': 'Create',
//     'url': '{$route}?category=' + $('#form-category').val(),
// });
});
EOT;
    }
} 