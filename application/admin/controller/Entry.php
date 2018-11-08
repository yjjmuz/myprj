<?php
namespace app\admin\controller;
use app\common\model\Admin;

class Entry extends Common
{
    
    public function index()
    {
        return $this->fetch();
    }
    /*
     * 修改密码
     */
    public function pass()
    {
        if(request()->isPost()){
            $res = (new Admin())->pass((input('post.')));
            if($res['valid']){
                //清除session信息
                session(null);
                $this->success($res['msg'],'admin/entry/index');
            }else{
                $this->error($res['msg']);
            }
        }
        return $this->fetch();
    }
}