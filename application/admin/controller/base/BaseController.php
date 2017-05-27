<?php
/**
 * Created by PhpStorm.
 * User: freddy
 * Date: 2017/5/26
 * Time: 15:50
 */

namespace app\admin\controller\base;

use think\Controller;
use think\Request;

class BaseController extends Controller {

    protected function _initialize()
    {
        $request = Request::instance();
        $baseUrl = $request->baseUrl();
        $target = "user";
        // 判断用户是否登陆
        if(empty(session("userlog")) && strpos($baseUrl,$target) === false){
            return $this->redirect("/user/login");
        }
    }
    public function _empty()
    {
        //把所有城市的操作解析到city方法
        echo "xx";
    }


}