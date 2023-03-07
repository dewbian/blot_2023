<?php

namespace Encore\Admin\Controllers;

use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    use HasResourceActions;

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Title';

    /**
     * Set description for following 4 action pages.
     *
     * @var array
     */
    protected $description = [
        //        'index'  => 'Index',
        //        'show'   => 'Show',
        //        'edit'   => 'Edit',
        //        'create' => 'Create',
    ];

    /**
     * Get content title.
     *
     * @return string
     */
    protected function title()
    {
        return $this->title;
    }

    /**
     * Index interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['show'] ?? trans('admin.show'))
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     *
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'))
            ->body($this->form());
    }

    public function ckEditorUpload(Request $request)
    {     
        if (!$request->hasFile('upload')) {
            return response()->json([
                'message' => '파일이 정상적으로 업로드되지 않았습니다'
            ], 400);
        }
        $uploadFile = $request->file('upload');

        // 파일이 한개일때 배열에 담아줌 (아래 코드를 여러개일때도 같이 쓰게)
        if (!is_array($uploadFile)) {
            $uploadFile = [$uploadFile];
        }
        $filename = [];
        $urls = [];
        foreach ($uploadFile as $file) {
            $ext = $file->getClientOriginalExtension();
            $file_name = uniqid(rand(), false).'.'.$ext;

            // $dirpath = 'editor/'.date('Ym');
            // Storage::put('public/'.$dirpath.'/'.$file_name, file_get_contents($file));

            // $filename[] = $file_name;
            // $urls[] = '/storage/'.$dirpath.'/'.$file_name;



            $dirpath = 'editor/'.date('Ym');
            //dd("public_path===>[".'public/'.$dirpath.'/'.$file_name."]"); 
            Storage::put( 'public/'.$dirpath.'/'.$file_name, file_get_contents($file));

            $filename[] = $file_name;
            $urls[] = '/storage/'.$dirpath.'/'.$file_name;
 

        }

        return response()->json([
            'uploaded' => 1,
            'fileName' => $filename,
            'url' => $urls,
        ]);
     
     
        // $image = $request->file('upload'); // get file 
        // // response

        // $request->file('uploadFile')->store('images', 'public');
        // //$file = $request->uploadFile->store('images');
        // return redirect()->route('page11');


        // $param = [
        //         'uploaded' => 1,
        //         'fileName' => file_name,
        //         'url' =>  $urls,
        // ];
        return response()->json($param, 200); 
    }
}
