<?php
namespace App\Http\Controllers\CustomizeAdmin; 

use App\BlotBoard;
use App\blot_config;
use Illuminate\Http\Request;
use Encore\Admin\Form;
use Encore\Admin\Show;
use Encore\Admin\Grid; 
use Encore\Admin\Controllers\AdminController;
use Illuminate\Support\Facades\Redirect; 
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Admin\Actions\Post\Replicate;


class BlotBoardController extends AdminController
{    
    protected function title()
    {
        return "게시판 설정";
    }

    protected function grid()
    { 
        $boardModel = BlotBoard::class; 
        $grid = new Grid(new $boardModel());
        $grid->disableColumnSelector();
        $grid->disableExport();

        $grid->column('bo_table', '게시판 이름')->width(500)->display(function($title) {
            return str_limit($title, 30, '...');
        })->sortable();
        
        $grid->column('bo_skin', '게시판 스킨')->width(500);
         
        $grid->actions(function (Grid\Displayers\Actions $actions) {            
            $actions->disableView();
            $actions->add(new Replicate); 
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
        $boardModel = BlotBoard::class; 

        $show = new Show($boardModel::findOrFail($id));

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
        $boardModel = BlotBoard::class; 
        $form = new Form(new $boardModel());
 
        $form->text('bo_table', '게시판이름')->pattern('[A-z0-9][_]?{3}')->rules('required')->help( '영문자,숫자,_만 가능(공백없이20자 이내)' );
        $form->select('bo_skin', '게시판 스킨 형식')->rules('required')
        ->options(['basic' => 'basic', 'gallery' => 'gallery', 'blog' => 'blog']);
        $form->text('bo_subject', '게시판제목')->rules('required'); 
        //->options(array('basic','gallery','blog'));
       // $form->number('bo_order', '노출 순서')->rules('required')->min(1);
        $form->number('bo_list_count', '리스트 나열 개수')->min(5);           
  
        $form->checkbox('bo_category_use', '카테고리사용')->options( [ 1 => '예']); 


        // $form->embeds('column_name', function ($form) {

        //     $form->text('key1','aa')->rules('required');
        //     $form->email('key2')->rules('required');
        //     $form->datetime('key3');
        
        //     $form->dateRange('key4','key5','Range')->rules('required');
        // });


        $form->table('bo_category', '카테고리', function ($table) { 
             $table->text('category1');
             $table->text('category2');
        });

        //$form->checkbox('pop_mobile' ,'노출기기')->options( [1 => '모바일'] );
        //$form->checkbox('pop_web' ,'PC')->options( [1 => 'PC'] );  
        

        // $form->multipleSelect('http_method', trans('admin.http.method'))
        // ->options($this->getSkinSelect())
        // ->help(trans('admin.all_methods_if_empty'));
       //array_combine("bb" )  
        $form->saving(function (Form $form) { 
            //dd("use==>[".json_encode(array_values($form->bo_category_use) )."] 또는 =>[". $form->bo_category_use . "]");
            //dd("use==>[".json_encode($form->bo_category_use)."] 또는 =>[". $form->bo_category_use . "]");
            \DB::enableQueryLog(); 
           // $this->makeTable($form->bo_table);
        });

        $form->saved(function (Form $form) {
           // dd("ㅋㅋ".\DB::getQueryLog());
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

    Log::info('C:\blot_2022\app\Http\Controllers\CustomizeAdmin\BlotBoardController.php function makeTable=$bo_table==>['.$bo_table.']'); 
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

    //dd('C:\blot_2022\app\Http\Controllers\CustomizeAdmin\BlotBoardController.php function makeTable===>['.'blot_board_'.$bo_table.']'); 
}


}