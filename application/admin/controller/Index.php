<?php
namespace app\admin\controller;
use app\admin\controller\base\BaseController;
use think\Db;
use think\Request;
use app\admin\model\TodoList;
class Index extends BaseController
{
    public $activeMenu = "dashboard";
//    public function _initialize()
//    {
//        // 判断用户是否登陆
//        if(empty(session("userlog"))){
//            return $this->redirect("/user/login");
//        }
//    }

    public function index (Request $request)
    {
//        dump($request->controller());
        return $this->fetch("index/index",array("active"=>"dashboard"));
    }




}
