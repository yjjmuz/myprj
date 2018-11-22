<?php
namespace app\admin\controller;

use think\Controller;
use app\common\model\Category;

class Article extends Controller
{
    public function index()
    {
//         return $this->fetch();
    }
    
    public function store()
    {
        $cateData = (new Category())->select();
        $this->assign('cateData',$cateData);
        
        $tagData = db('tag')->select();
        halt($tagData);
        halt($cateData);
//         return $this->fetch();
    }
}