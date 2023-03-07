<? 
namespace App\Admin\Actions;

use Encore\Admin\Grid\Tools\AbstractTool;
use Encore\Admin\Widgets\Form;
use Illuminate\Support\Facades\DB;

class AddButton extends AbstractTool
{ 

    
    public function render()
    {
        return '<a class="btn btn-sm btn-success" href="/add">Addaaaaaaaaaaaaaaaaaaaaaaa</a>';
    }
    // public function __construct(){
    //     dd ("contraskdkd");
    // }

//     public function render1()
//     {
//         $form = new Form();
//         $form->select('category', '카테고리')->options([
//             'option1' => '옵션1',
//             'option2' => '옵션2',
//             'option3' => '옵션3',
//         ]);

//         $form->setWidth(4, 4);

//         return  <<<EOT
// <div class="btn-group pull-right" style="margin-right: 10px">
//     <a class="btn btn-sm btn-twitter" id="add-data" title="Add new">
//         <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;Add new</span>
//     </a>
// </div>
// EOT;
//     }

//     protected function script()
//     {
//         $route = route('blot_board_content.create');

//         return <<<EOT
// $('#add-data').on('click', function() {
//     LA.Request.modal({
//         'title': 'Create',
//         'url': '{$route}?category=' + $('#form-category').val(),
//     });
// });
// EOT;
//     }
}