<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use app\admin\model\TodoList;
class Index extends Controller
{
    public function index ()
    {
        return $this->fetch("index/index");
    }
    public function login()
    {
        return $this->fetch('public/login');
    }







    public function addList (Request $request) {

//        if (!$http->isAjax()) {
//            return json(array('code'=>101,'desc'=>'非法请求','data'=>null));
//        }
        $data = [];
        $param = $request->param();
        if ( !isset($param['list_name'])) {
            return json(array('code'=>102,'desc'=>'请传入list_name','data'=>null));
        }
        $data['list_name'] = $param['list_name'];

        if (isset($param['remind_time']) && strlen($param['remind_time']) > 0) {
            $data['remind_time'] = $request['remind_time'];
        }
        $query = Db::name('todo_list')->insert($data);

        if ($query) {
            return json(array('code'=>200,'msg'=>'插入成功','data'=>$query));
        }
        return json(array('code'=>103,'msg'=>'添加失败','data'=>null));

    }
    public function addTask (Request $request) {
//        if (!$http->isAjax()) {
//            return json(array('code'=>101,'desc'=>'非法请求','data'=>null));
//        }
        $data = [];
        $param = $request->param();
        if ( !isset($param['task_name'])) {
            return json(array('code'=>102,'desc'=>'请传入task_name','data'=>null));
        }
        $data['task_name'] = $param['task_name'];

        if (isset($param['remind_time']) && strlen($param['remind_time']) > 0) {
            $data['remind_time'] = $param['remind_time'];
        }
        $query = Db::name('todo_list')->insert($param);

        if ($query) {
            return json(array('code'=>200,'msg'=>'插入成功','data'=>$query));
        }
        return json(array('code'=>103,'msg'=>'添加失败','data'=>null));
    }
    public function getAll()
    {

        // 实例化模型，保存至数据库
        $todo = Db::name('todo_list');

        $list = $todo ->select();

        return json(array('code'=>200,'msg'=>'获取成功','data'=>$list));
    }
    public function update(Request $request)
    {
        // 获取客户端提交的数据
        $post = Request::instance()->only(['id'],'param');
        $todo = Db::name('todo_list');
        $list = $todo->where(['status'=>$post['id']])
            ->update();

        return json($list);
    }
}
