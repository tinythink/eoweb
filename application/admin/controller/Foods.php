<?php
namespace app\admin\controller;
use app\admin\controller\base\BaseController;
use think\Db;
use think\Request;
class Foods extends BaseController
{
    public function index()
    {
        $re = Db::query('select f.id,f.name,f.insert_time,t.name as type from eo_foods f LEFT JOIN eo_type t ON f.t_id = t.id where f.sts > 0');
        $types = Db::name('type')->field(['id','name'])->select();
        return $this->fetch('foods/index',array("active"=>"food","list"=>$re,"type"=>$types));
    }

    public function add (Request $request) {

        $param = $request->param();

        // 验证客户端传输的数据
        if (!isset($param['name'])) {
            return json(array('code'=>200,'msg'=>'请传入foodName'));
        }

        if (!isset($param['t_id'])) {
            return json(array('code'=>200,'msg'=>'请传入食品类型'));
        }
        $param['insert_time'] = time();
        $query = Db::name('foods')->insert($param);

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

    public function del(Request $request)
    {
        // 获取客户端提交的数据
        $post =  $request->only(['id'],'param');
        $todo = Db::name('foods');
        $list = $todo->where(['id'=>$post['id']])
            ->update(['sts'=>0]);
        if ($list) {
            return json(array('code'=>200,'msg'=>'删除成功'));
        }
        return json(array('code'=>109,'msg'=>'删除失败'));
    }
    public function find(Request $request)
    {
        // 获取客户端提交的数据
        $param=  $request->param();
        if (!isset($param['id'])) {
            return json(array('code'=>103,'msg'=>'参数不正确'));
        }
        $type = Db::name('foods');
        $list = $type->where(['id'=>$param['id']])
            ->find();
//        $data = Db::table('eo_foods')
//            ->alias('f')
//            ->join('eo_type t','f.t_id = t.id','LEFT')
//            ->field('f.id,f.name,f.insert_time,t.name as type')
//            ->where('t.sts','>',0)
//            ->where('f.sts','>',0)
//            ->select();
        if ($list) {
            return json(array('code'=>200,'msg'=>'查询成功','data'=>$list));
        }
        return json(array('code'=>109,'msg'=>'查询失败'));
    }
    public function update(Request $request)
    {
        // 获取客户端提交的数据
        $param=  $request->post();
        $type = Db::name('foods');
        $list = $type->where(['id'=>$param['id']])
            ->update($param);
        if ($list) {
            return json(array('code'=>200,'msg'=>'更新成功'));
        }
        return json(array('code'=>109,'msg'=>'更新失败','data'=>$list));
    }
}
