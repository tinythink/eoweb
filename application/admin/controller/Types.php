<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
class Types extends Controller
{




    public function add (Request $request) {

//        if (!$http->isAjax()) {
//            return json(array('code'=>101,'desc'=>'非法请求','data'=>null));
//        }
        $data = [];
        $param = $request->param();
        if ( !isset($param['name'])) {
            return json(array('code'=>102,'desc'=>'请传入name','data'=>null));
        }
        $data['name'] = $param['name'];
        $data['insert_time'] = time();

        $type = Db::name('type');

        $find = $type->where(["name"=>$param['name']])->find();

        if (!empty($find)) {
            return json(array('code'=>104,'msg'=>'重复','data'=>null));
        }

        $query = $type->insert($data);

        if ($query) {
            return json(array('code'=>200,'msg'=>'插入成功','data'=>$query));
        }
        return json(array('code'=>103,'msg'=>'添加失败','data'=>null));

    }

    public function del(Request $request)
    {
        // 获取客户端提交的数据
        $post =  $request->only(['id'],'param');
        $todo = Db::name('type');
        $list = $todo->where(['id'=>$post['id']])
            ->update(['status'=>0]);
        if ($list) {
            return json(array('code'=>200,'msg'=>'删除成功'));
        }
        return json(array('code'=>109,'msg'=>'删除失败'));
    }

    public function update(Request $request)
    {
        // 获取客户端提交的数据
        $param=  $request->param();
        $type = Db::name('type');
        $list = $type->where(['id'=>$param['id']])
            ->update($param);
        if ($list) {
            return json(array('code'=>200,'msg'=>'更新成功'));
        }
        return json(array('code'=>109,'msg'=>'更新失败'));
    }


    public function addTask (Request $request) {
//        if (!$http->isAjax()) {
//            return json(array('code'=>101,'desc'=>'非法请求','data'=>null));
//        }
        $data = [];
        $param = $request->param();
        if ( !isset($param['task_name'])) {
            return json(array('code'=>102,'msg'=>'请传入task_name','data'=>null));
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
}
