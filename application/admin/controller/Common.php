<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Common extends Controller{
    public function __construct( Request $requst = null)
    {
        parent::__construct($requst);
        if(!session('admin.admin_id'))
        {
            $this->redirect('admin/login/login');
        }
    }
}