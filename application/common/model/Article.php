<?php
namespace app\common\model;

use think\Model;

class Article extends Model
{
    protected $pk = 'arc_id';
    protected $table = 'blog_article';
    protected $auto = ['admin_id'];
    protected $insert = ['sendtime'];
    protected $update = ['updatetime'];
    protected function setAdminIdAttr($value)
    {
        return session('admin.admin_id');
    }
    protected function setSendTimeAttr($value)
    {
        return time();
    }
    protected function setUpdateTimeAttr($value)
    {
        return time();
    }
    
    public function store($data)
    {
        if(isset($data['tag'])){
            $arcTagData = [
                'arc_tag'   =>$this->arc_id,
                'tag_id'    =>(input('post.tag'))
            ];
            (new Tag())->save($arcTagData);
        }
    }
}