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
        $data = Db::name('type')->where('sts','>',0)->select();
        return $this->fetch('types/index',array("active"=>"type","list"=>$data));
    }
    public function food()
    {
        $re = Db::query('select f.id,f.name,f.insert_time,t.name as type from eo_foods f LEFT JOIN eo_type t ON f.t_id = t.id where f.sts > 0');
        $types = Db::name('type')->field(['id','name'])->select();
        return $this->fetch('foods/index',array("active"=>"food","list"=>$re,"type"=>$types));
    }

    public function news()
    {
        $news = Db::name('news')->select();
        return $this->fetch('news/index',array("active"=>"news","list"=>$news));
    }
}
