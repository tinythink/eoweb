<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
class Hero extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    }

    public function add () {

//        if (!$http->isAjax()) {
//            return json(array('code'=>101,'desc'=>'非法请求','data'=>null));
//        }
        $param = $this->request->param();

        // 验证客户端传输的数据
        $validate = validate('Hero');
        if( !$validate->check($param) ){
            return json(array('code'=>110,'desc'=>'参数错误','data'=>[$validate->getError()]));
        }

        $query = Db::name('heroes')->insert($param);

        if ($query) {
            return json(array('code'=>200,'msg'=>'插入成功','data'=>$query));
        }
        return json(array('code'=>103,'msg'=>'添加失败','data'=>null));

    }
    public function addAll (Request $request) {

//        if (!$http->isAjax()) {
//            return json(array('code'=>101,'desc'=>'非法请求','data'=>null));
//        }
        $param = $request->param();
        // 验证客户端传输的数据
        $validate = validate('Hero');
        if( !$validate->check($param) ){
            return json(array('code'=>110,'desc'=>'参数错误','data'=>[$validate->getError()]));
        }
        $query = Db::name('heroes')->insertAll($param);

        if ($query) {
            return json(array('code'=>200,'msg'=>'插入成功','data'=>$query));
        }
        return json(array('code'=>103,'msg'=>'添加失败','data'=>null));

    }

    public function getAll()
    {

        // 实例化模型，保存至数据库
        $heroes = Db::name('heroes');

        $list = $heroes ->select();

        return json(array('code'=>200,'msg'=>'获取成功','data'=>$list));
    }
    public function findById(Request $request)
    {

        // 获取客户端提交的数据
        $post = $request->only(['id'],'param');
        if (!isset($post['id'])) {
            return json(array('code'=>110,'msg'=>'参数错误','data'=>null));
        }
        // 实例化模型，保存至数据库
        $heroes = Db::name('heroes');

        $list = $heroes ->where($post)->select();
        return json(array('code'=>200,'msg'=>'获取成功','data'=>$list));
    }
    public function findByType(Request $request)
    {

        // 获取客户端提交的数据
        $post = $request->only(['type'],'param');
        if (!isset($post['type'])) {
            return json(array('code'=>110,'msg'=>'参数错误','data'=>null));
        }
        // 实例化模型，保存至数据库
        $heroes = Db::name('heroes');

        $list = $heroes ->where($post)->select();
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
