<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">최근 컨텐츠</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped"> 
                @foreach($results as $result)
                <tr>
                    <td  width="130px">{{  $result->created_at }}</td>
                    <td  width="130px">{{  $result->member_id }}</td>
                    <td><a href="/master/blot_board_content/{{$result->id}}/edit">
                        @if (strlen($result->title) < 50)
                        {{ substr($result->title, 0, 50) }}
                        @else
                        {{ $result->title }}...
                        @endif    
                        </a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
</div>