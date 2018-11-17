<?php
namespace app\common\model;

use think\Model;
use function think\startTrans;

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
    public function getCateData($cate_id)
    {
//         halt(db('cate')->select());
        $cate_ids = $this->getSon(db('cate')->select(),$cate_id);
        $cate_ids[] = $cate_id;
        $field = db('cate')->whereNotIn('cate_id', $cate_ids)->select();
//         halt($field);
        return $field;
    }
    public function getSon($data,$cate_id)
    {
        static $temp = [];
        foreach ($data as $k => $v)
        {
            if($cate_id == $v['cate_pid'])
            {
                $temp[] = $v['cate_id'];
                $this->getSon($data, $v['cate_id']);
            }
        }
        return $temp;
    }
    
    public function edit($data)
    {
        $result = $this->validate(true)->save($data,[$this->pk=>$data['cate_id']]);
        if($result)        {
            return ['valid'=>1,'msg'=>'编辑成功'];
        }else{
            return ['valid'=>0,'msg'=>$this->getError()];
        }
    }
    
    public function del($cate_id)
    {
//         dump($cate_id);
        $cate_pid = $this->where('cate_id',$cate_id)->value('cate_id');
        
        $this->where('cate_pid',$cate_id) ->update(['cate_pid' => $cate_pid]);
        
        if(Category::destroy($cate_id)){
            return ['valid' =>1,'msg'=>'删除成功'];
        }else{
            return ['valid' =>0,'msg'=>'删除失败'];
        }
    }
}