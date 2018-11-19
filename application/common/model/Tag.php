<?php
namespace app\common\model;

use think\Model;

class Tag extends Model
{
    protected $pk = 'tag_id';
    protected $table = 'blog_tag';
    
    public function store($data)
    {
        $result = $this->validate(true)->save($data);
        
        if($result == false){
            return ['valid' =>0,'msg'=>$this->getError()];
        }else{
            return ['valid' =>1,'msg'=>'添加成功'];
        }
    }
    
    public function edit($data)
    {
//         halt($data);
        $result = $this->validate(true)->save($data,[$this->pk=>$data['tag_id']]);
        if($result){
            return ['valid' =>1,'msg'=>'添加成功'];
        }else{
            return ['valid' =>0,'msg' =>$this->getError()];
        }
    }
    
    public function del($tag_id)
    {
        if(Tag::destroy($tag_id)){
            return ['valid'=>1,'msg'=>'删除成功'];
        }else{
            return ['valid'=>0,'msg'=>'删除失败'];
        }
    }
}