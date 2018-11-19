<?php
namespace app\admin\controller;
use think\Controller;

class Category extends Controller
{
    protected $db;
    protected function _initialize()
    {
        parent::_initialize();
        $this->db = new \app\common\model\Category();
    }
    public function index()
    {
//         halt($this->db);
        $field = db('cate')->select();
//         $field = $this->db->getAll();
        $this->assign('field',$field);
        return $this->fetch();
    }
    public function store()
    {
        if(request()->isPost())
        {
            $res = $this->db->store(input('post.'));
            if($res['valid']){
                $this->success($res['msg'],'index');exit;
            }else{
                $this->error($res['msg']);exit;
            }
            
        }
        return $this->fetch();
    }
    public function addSon()
    {
        if(request()->isPost())
        {
            $res = $this->db->store(input('post.'));
            if($res['valid']){
                $this->success($res['msg'],'index');exit;
            }else{
                $this->error($res['msg']);exit;
            }
        
        }
        $cate_id = input('param.cate_id');
        $data = $this->db->where('cate_id',$cate_id)->find();
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function edit()
    {
        if(request() ->isPost())
        {
//             halt($_POST);
            $res = $this->db->edit(input('post.'));
            if($res['valid']){
                $this->success($res['msg'],'index');exit;
            }else{
                $this->error($res['msg']);exit;
            }
        }
        $cate_id = input('param.cate_id');
        $oldData = $this->db->find($cate_id);
//         dump($oldData);
        $this->assign('oldData',$oldData);
        $cateData = $this->db->getCateData($cate_id);
//         halt($cateData);
        $this->assign('cateData',$cateData);
        return $this->fetch();
    }
    public function del()
    {
//         halt(input('param.cate_id'));
        $res = $this->db->del( input('param.cate_id'));
        if($res['valid']){
//             dump($res);
            return $this->success($res['msg'],'index');
        }else{
            return $this->error($res['msg'],'index');        
        }
    }
}