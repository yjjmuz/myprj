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
}