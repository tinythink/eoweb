<?php
namespace app\index\controller;


use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch('index');
    }
    public function test()
    {
        return $this->fetch('index/test');
    }
    public function receive()
    {
        return json($_POST);
    }
}
