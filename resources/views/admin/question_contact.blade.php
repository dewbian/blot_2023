    
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">  


@if (\Session::has('message')) 
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>{!! \Session::get('message') !!}</h4>  
    </div>
@endif 
여기서 가져올 값은 <br><br><br>
{{ $aa->con_company }} 
  <!-- 
<div class="box-body">
    <div class="fields-group">                                               
        <div class="col-md-12">
            <div class="form-group  ">
                <label for="cf_title" class="col-sm-2 asterisk control-label">홈페이지 제목</label>
                <div class="col-sm-8">
                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                    <input type="text" id="cf_title" name="cf_title" value="" class="form-control username" placeholder="홈페이지 제목">
                    </div>
                </div>
            </div>
            <div class="form-group  ">
                <label for="cf_admin_email" class="col-sm-2 asterisk control-label">관리자 메일 주소</label>
                <div class="col-sm-8">
                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                    <input type="text" id="cf_admin_email" name="cf_admin_email" value="" class="form-control name" placeholder="xxx@xxx.xx">
                    </div> <span class="bootstrap-duallistbox-container info"><small>
                    관리자가 보내고 받는 용도로 사용하는 메일주소 (회원가입,인증메일, 테스트, 회원메일 발송등에서 사용)</small></span>
                </div>
            </div>
            <div class="form-group  ">
                <label for="cf_admin_email_name" class="col-sm-2 asterisk control-label">관리자 메일 발송 이름</label>
                <div class="col-sm-8">
                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                    <input type="text" id="cf_admin_email_name" name="cf_admin_email_name" value="" class="form-control name" placeholder="입력 이름">
                    </div> 
                    <span class="bootstrap-duallistbox-container info"><small>관리자가 보내고 받는 용도로 사용하는 발송 이름 (회원가입, 인증메일, 테스트, 회원메일발송 등에서 사용)</small></span>
                </div>
            </div> 
 
        </div>
    </div>
</div>

<div class="box-footer"> 
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="btn-group pull-right">
            <button type="submit" class="btn btn-primary">전송</button>
        </div>   
        <div class="btn-group pull-left">
            <button type="reset" class="btn btn-warning">초기화</button>
        </div>
    </div>
</div>
</form>
</div></div></div>
//-->
<script> 
// $(function () { ;(function () {
//     $('form.model-form-6376fa9202405').submit(function (e) {
//         e.preventDefault();
//         $(this).find('div.cascade-group.hide :input').attr('disabled', true);
//     });
// })();  
// $("input.avatar").fileinput({"overwriteInitial":true,"initialPreviewAsData":true,"msgPlaceholder":"\uc774\ubbf8\uc9c0 \uc120\ud0dd","browseLabel":"\ucc3e\uc544\ubcf4\uae30","cancelLabel":"\ucde8\uc18c","showRemove":false,"showUpload":false,"showCancel":false,"dropZoneEnabled":false,"deleteExtraData":{"avatar":"_file_del_","_file_del_":"","_token":"uYQ6zHnCVu0qrIrg7MhkVCtNAEM74Q6Q9HnKp4bA","_method":"PUT"},"deleteUrl":"http:\/\/127.0.0.1:8000\/admin\/auth\/","fileActionSettings":{"showRemove":false,"showDrag":false},"allowedFileTypes":["image"]});  $(".roles").select2({"allowClear":true,"placeholder":{"id":"","text":"\uc5ed\ud560"}});  $(".permissions").select2({"allowClear":true,"placeholder":{"id":"","text":"\uad8c\ud55c"}});          
// $('.after-submit').iCheck({checkboxClass:'icheckbox_minimal-blue'}).on('ifChecked', function () {
//     $('.after-submit').not(this).iCheck('uncheck');
// });  ;(function () {
//     $('.container-refresh').off('click').on('click', function() {
//         $.admin.reload();
//         $.admin.toastr.success('새로고침 성공 !', '', {positionClass:"toast-top-center"});
//     });
// })(); });
</script>