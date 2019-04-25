<?php
namespace app\index\controller;
header('Access-Control-Allow-Origin:*');

use think\Controller;

class Index extends Controller
{

    public function index()
    {
        return "法宝网";
    }
}