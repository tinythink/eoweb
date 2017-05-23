<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
class Foods extends Controller
{
//    public function __construct(Request $request)
//    {
//        parent::__construct($request);
//        header('Access-Control-Allow-Origin: *');
//        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
//    }

    public function add (Request $request) {

//        if (!$http->isAjax()) {
//            return json(array('code'=>101,'desc'=>'非法请求','data'=>null));
//        }
        $param = $request->param();

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
    public function upload(Request $request){
        // 获取表单上传文件 例如上传了001.jpg
        $file = $request->file('file');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        $host = $_SERVER['HTTP_HOST'];
        if($info){
            return json(array('code'=>200,'msg'=>'上传成功','data'=>['url'=>$host.'/uploads/'.$info->getSaveName()]));
        }
        return json(array('code'=>103,'msg'=>'上传成功','data'=>$file->getError()));
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
