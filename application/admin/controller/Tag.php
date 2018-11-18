<?php
namespace app\admin\controller;
use think\Controller;



class Tag extends Controller
{
    protected $db;
    
    public function index()
    {
        return $this->fetch();
    }
}