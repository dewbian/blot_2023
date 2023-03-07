<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">최근 프로젝트 문의</h3>

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
                    <td  ><a href="/master/blot_contact/{{$result->id}}">{{  $result->con_company }}</a></td>
                    <td  width="150px">{{  $result->con_department }}</td>
                    <td  width="150px">{{  $result->con_manager }}</td> 
                @endforeach
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
</div>