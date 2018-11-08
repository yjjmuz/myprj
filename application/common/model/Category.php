<?php
namespace app\common\model;

use think\Model;

class Category extends Model
{
    protected $pk = 'cate_id';
    protected $table = 'blog_cate';
    public function getAll()
    {
//         Arr::tree(db('cate')->order('cate_sort desc,cate_id')->select(),'cate_name',$fielPri = 'cate_id',$fielPid= 'cate_pid');
    }
    public function store($data)
    {
        $result = $this->validate(true)->save($data);
        if($result === false){
            return ['valid'=>0,'msg'=>$this->getError()];
        }else{
            return ['valid' =>1, 'msg' => '添加成功'];
        }
    }
}