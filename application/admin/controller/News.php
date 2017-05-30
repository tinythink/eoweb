<?php
namespace app\admin\controller;
use app\admin\controller\base\BaseController;
use think\Db;
use think\Request;
class News extends BaseController
{
    public function index()
    {
        $list = Db::name('news')->where('sts > 0')->select();
        return $this->fetch('news/index',array('list'=>$list,"active"=>"news"));
    }
    public function add()
    {
        return $this->fetch('news/add',array("active"=>"news"));
    }
    public function edit()
    {
        return $this->fetch('news/edit',array("active"=>"news"));
    }
    public function doAdd (Request $request) {

        $param = $request->param();

        // 验证客户端传输的数据
        if (!isset($param['title'])) {
            return json(array('code'=>200,'msg'=>'请传入新闻标题'));
        }

        if (!isset($param['content'])) {
            return json(array('code'=>200,'msg'=>'请传入新闻内容'));
        }
        $param['insert_time'] = time();
        $query = Db::name('news')->insert($param);

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
        $todo = Db::name('news');
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
        $type = Db::name('news');
        $list = $type->where(['id'=>$param['id']])
            ->find();
        if ($list) {
            return json(array('code'=>200,'msg'=>'查询成功','data'=>$list));
        }
        return json(array('code'=>109,'msg'=>'查询失败'));
    }
    public function update(Request $request)
    {
        // 获取客户端提交的数据
        $param=  $request->post();
        $type = Db::name('news');
        $list = $type->where(['id'=>$param['id']])
            ->update($param);
        if ($list) {
            return json(array('code'=>200,'msg'=>'更新成功'));
        }
        return json(array('code'=>109,'msg'=>'更新失败','data'=>$list));
    }
}
