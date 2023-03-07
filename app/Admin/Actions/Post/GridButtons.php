<? 
namespace App\Admin\Actions\Post;

use Encore\Admin\Grid; 



class GridButtons extends  Grid\Tools\CreateButton 
{
     
    protected $options; 

    public function __construct() //$options
    {
        dd("contsruce");
        $this->options = ['ber'=> '1', 'bar' => '2' ];
    }

    protected function href()
    {
        return "javascript:;";
    }

    public function render()
    {
        //$this->setupScript();

        //$create = trans('admin.create');

       // $text = $this->getText();

        //$options = json_encode($this->options);

        return <<<EOT
<div class="btn-group pull-right" style="margin-right: 10px">
    <a class="btn btn-sm btn-success" id="create-btn"><i class="fa fa-plus"></i>&nbsp;&nbsp;{$text}</a>
</div>

<script>
$(function () {
    $('#create-btn').click(function () {
        LA.Request({
            url: '{$this->resource()}/create',
            data: {
                _editable: 1,
                _popup: 1,
            },
            success: function (data) {
                $('#form-modal .modal-content').html(data);
                $('#form-modal').modal();
            }
        });
    });
});
</script>
EOT;
    }
}