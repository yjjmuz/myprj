<?php
namespace app\admin\controller;
use think\Controller;



class Tag extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
}