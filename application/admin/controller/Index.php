<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use app\admin\model\TodoList;
class Index extends Controller
{
    public $activeMenu = "dashboard";
    public function index ()
    {
        return $this->fetch("index/index",array("active"=>"dashboard"));
    }
    public function login()
    {
        return $this->fetch('public/login');
    }
    public function type()
    {
        $data = Db::name('type')->where('status','>',0)->select();
//        dump($data);
        return $this->fetch('types/index',array("active"=>"type","list"=>$data));
    }
    public function food()
    {
        $data = Db::name('foods')->select();
        $types = Db::name('type')->field(['id','name'])->select();
        return $this->fetch('foods/index',array("active"=>"food","list"=>$data,"type"=>$types));
    }
}
