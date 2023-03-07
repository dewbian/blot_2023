<style>
    .title {
        font-size: 50px;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        display: block;
        text-align: center;
        margin: 20px 0 10px 0px;
    }

    .links {
        text-align: center;
        margin-bottom: 20px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }


.box-body{
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 2px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1)
}
</style>

<div class="box-body">
        <div class="table-responsive" style="bg-color:white;">
            <table class="table table-striped">
                <tbody>
                <tr>
                    <td width="120px">회사명</td>
                    <td>{{ $contact->con_company}}</td>
                    <td width="120px">담당부서</td>
                    <td>{{ $contact->con_department}}</td>
                </tr> 
                <tr>
                    <td width="120px">담당자명</td>
                    <td>{{ $contact->con_manager}}</td>
                    <td width="120px">연락처</td>
                    <td>{{ $contact->con_tel}}</td>
                </tr> 
                <tr>
                    <td width="120px">이메일</td>
                    <td>{{ $contact->con_email}}</td>
                    <td width="120px">홈페이지URL</td>
                    <td>{{ $contact->con_url}}</td>
                </tr> 
                <tr>
                    <td width="120px">회사주소</td>
                    <td colspan="3">{{ $contact->con_address}}</td> 
                </tr> 
                <tr>
                    <td width="120px">신청서비스</td>
                    <td colspan="3">{{ $contact->con_service}}</td> 
                </tr> 
                <tr>
                    <td width="120px">참고사이트01</td>
                    <td>{{ $contact->con_referrence01}}</td>
                    <td width="120px">참고사이트02</td>
                    <td>{{ $contact->con_referrence02}}</td>
                </tr> 
                <tr>
                    <td width="120px">오픈 예상일</td>
                    <td colspan="3">{{ $contact->con_date}}</td> 
                </tr> 
                <tr>
                    <td width="120px">예상 견적금액</td>
                    <td colspan="3">{{ $contact->con_budget}}</td> 
                </tr> 
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div> 
    @if($contact->con_answerYN == 'Y')

    <div class="box-body">        
        <div class="table-responsive" style="bg-color:white;">
            <table class="table table-striped">
                <tbody> 
                <tr>
                    <td width="120px">답변등록일</td>
                    <td>{{ $contact->con_answer_date}}</td>
                    <td width="120px">답변자 </td>
                    <td>{{ $contact->con_answer_id}}</td>
                </tr> 
                <tr>
                    <td width="120px">답변내용</td>
                    <td colspan="3">{!! nl2br($contact->con_answer_text) !!}</td> 
                </tr>  
                </tbody>
            </table>
        </div>
    </div>
    @endif