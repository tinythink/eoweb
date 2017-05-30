<?php
/**
 * Created by PhpStorm.
 * User: dobbin
 * Date: 2017/5/18
 * Time: 16:22
 */
namespace app\admin\controller;
use app\admin\controller\base\BaseController;
use think\Db;
use think\helper\hash\Md5;
use think\Request;


class User extends BaseController {

    public function index()
    {
        return $this->fetch('user/login');
    }

    public function do_login (Request $request) {

        $params = $request->request();
        // 是否传入用户名
        if (!array_key_exists('username',$params)) {
            return json(array("code"=>"101","desc"=>"请传入登录信息"));
        }
        $users = Db::name("users");
        // 验证用户名是否存在
        $isExitUsName = $users->field('id')->where(array("username"=>$params['username']))->find();
        if (!$isExitUsName) {
            return json(array("code"=>"102","desc"=>"用户名不存在"));
        }
        // 验证用户名和密码是否匹配
        $check = $users->field('id')->where(array("username"=>$params["username"],"password"=>Md5($params["password"])))->find();
        if (!empty($check)) {
            session("userlog",$check);
            return json(array("code"=>"200","desc"=>"登录成功","data"=>$check));
        }
        return json(array("code"=>"104","desc"=>"用户名和密码不匹配","data"=>$check));
        // 登录成功session用户信息
    }

    public function find_user (Request $request) {
        $params = $request->request();
        // 是否传入用户名
        if (!array_key_exists('username',$params)) {
            return json(array("code"=>"101","desc"=>"请求参数不存在"));
        }
        $users = Db::name("users");
        // 验证用户名是否存在
        $isExitUsName = $users->field('id')->where(array("username"=>$params['username']))->find();
        if (!$isExitUsName) {
            return json(array("code"=>"102","desc"=>"用户名不存在"));
        }
        return json(array("code"=>"200","desc"=>"请求成功"));
    }

    public function logout () {

        session("userlog",null);
        return json(array("code"=>"200","desc"=>"退出登录成功"));
    }
}