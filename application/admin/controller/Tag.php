<?php
namespace app\admin\controller;

use think\Controller;

class Tag extends Common
{
    protected $db;
    protected function _initialize()
    {
        parent::_initialize();
        $this->db = new \app\common\model\Tag();
    }
    
    public function index()
    {
        $field = db('tag')->select();
        $this->assign('field',$field);
//         halt($field);
        return $this->fetch();
    }
    public function store()
    {
        if(request()->isPost()){
//             halt(input('post.'));
            $res = $this->db->store(input('post.'));
            if($res['valid']==0){
                $this->error($res['msg']);exit;
            }else{
                $this->success($res['msg'],'index');exit;
            }
        }
        
        return $this->fetch();
    }
    public function edit()
    {
        if(request()->isPost()){
            $res = $this->db->edit(input('post.'));
            if($res['valid'] ==0){
                $this->error($res['msg']);exit;
            }else{
                $this->success($res['msg'],'index');exit;
            }
        }
        $oldData = $this->db->find(input('param.tag_id'));
        $this->assign('oldData',$oldData);        

        return $this->fetch();
    }
    
    public function del()
    {
        $res = $this->db->del(input('param.tag_id'));
        if($res['valid']){
            $this->success($res['msg'],'index');
        }else{
            $this->error($res['msg']);
        }
        return $this->fetch();
    }
}