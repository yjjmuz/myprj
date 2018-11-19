<?php
namespace app\common\model;

use think\Model;
use think\Loader;
use think\Validate;

class Admin extends Model
{
    protected $pk = 'admin_id';
    protected $table = 'blog_admin';
    
    public function login($data)
    {
        $validate = Loader::validate(('Admin'));
        if(!$validate -> check($data)){
            return ['valid'=>0,'msg'=>$validate->getError()];            
        }
        $userInfo = $this->where('admin_username',$data['admin_username'])->where('admin_password',$data['admin_password'])->find();
        if(!$userInfo)        {
            return ['valid'=>0,'msg'=>'用户名或密码不正确'];
        }
        session('admin.admin_id',$userInfo['admin_id']);
        session('admin.admin_username',$userInfo['admin_username']);
        return  ['valid'=>1,'msg'=>'登录成功'];
    }
    /*
     * @
     */
    public function pass($data)
    {
        $validate = new Validate([
            'admin_password'    =>'require',
            'new_password'      =>'require',
            'confirm_password'  =>'require|confirm:new_password'
        ],[
            'admin_password.require'    =>'请输入原密码',
            'new_password.require'    =>'请输入新密码',
            'confirm_password.require'    =>'请输入确认密码',
            'confirm_password.confirm'    =>'两次密码输入不一致',
        ]);
        if(!$validate->check($data)){
            return ['valid'=>0,'msg'=>$validate->getError()];
//             dump($validate->getError());
        }
        $userInfo = $this->where('admin_id',session('admin.admin_id'))->where('admin_password',$data['admin_password'])->find();
        if(!$userInfo){
            return ['valid'=>0,'msg'=>'错误'];
        }
        $res = $this->save([
            'admin_password'    =>$data['new_password']
        ],[$this->pk => session('admin.admin_id')]);
        if($res){
            return ['valid'=>1,'msg'=>'密码修改成功'];
        }
            
    }
    
}