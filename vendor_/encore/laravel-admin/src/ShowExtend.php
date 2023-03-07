<?php

namespace Encore\Admin;
use Encore\Admin\Show;

class ShowExtend extends Show
{
    protected function disableActions()
    {
        $this->disableViewButton(); // 보기 버튼 비활성화
        $this->disableEditButton(); // 수정 버튼 비활성화
        $this->disableDeleteButton(); // 삭제 버튼 비활성화
        // 필요한 경우 다른 버튼도 비활성화할 수 있습니다.
    }

    // 그 외의 메소드들 ...
}
